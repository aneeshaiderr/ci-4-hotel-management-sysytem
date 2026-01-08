<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\DiscountModel;
use Config\Services;

class DiscountController extends BaseController
{
    protected $discountModel;
    protected $request;
    protected $session;

    public function __construct()
    {
        $this->discountModel = new DiscountModel();
        $this->request = Services::request();
        $this->session = Services::session();
    }

    /**
     * List all discounts
     */
    public function index()
    {
        $discounts = $this->discountModel->getAllDiscounts();
        return $this->render('Dashboard/Discount/discount', [
            'discounts' => $discounts
        ]);
    }

    /**
     * Show create discount form
     */
    public function create()
    {
        return $this->render('Dashboard/Discount/create');
    }

    /**
     * Store new discount
     */
    public function store()
    {
        if ($this->request->getMethod() == 'post') {
            return redirect()->to('/discount');
        }

        $data = [
            'discount_type' => $this->request->getPost('discount_type'),
            'discount_name' => $this->request->getPost('discount_name'),
            'value'         => $this->request->getPost('value'),
            'start_date'    => $this->request->getPost('start_date'),
            'end_date'      => $this->request->getPost('end_date'),
            'status'        => $this->request->getPost('status'),
        ];

        try {
            $this->discountModel->insert($data);
            $this->session->setFlashdata('success', 'Discount created successfully.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Error creating discount: '.$e->getMessage());
        }

        return redirect()->to('/discount');
    }

    /**
     * Show edit discount form
     */
    public function edit($id = null)
    {
        if (!$id) {
            $id = (int)$this->request->getGet('id');
        }

        $discount = $this->discountModel->find($id);
        if (!$discount) {
            $this->session->setFlashdata('error', 'Discount not found.');
            return redirect()->to('/discount');
        }

        return $this->render('Dashboard/Discount/edit', [
            'discount' => $discount
        ]);
    }

    /**
     * Update discount
     */
    public function update()
    {
        if ($this->request->getMethod() == 'post') {
            return redirect()->to('/discount');
        }

        $id = $this->request->getPost('id');
        if (!$id) {
            $this->session->setFlashdata('error', 'Discount ID is required.');
            return redirect()->back()->withInput();
        }

        $data = [
            'discount_type' => $this->request->getPost('discount_type'),
            'discount_name' => $this->request->getPost('discount_name'),
            'value'         => $this->request->getPost('value'),
            'start_date'    => $this->request->getPost('start_date'),
            'end_date'      => $this->request->getPost('end_date'),
            'status'        => $this->request->getPost('status'),
        ];

        try {
            $this->discountModel->update($id, $data);
            $this->session->setFlashdata('success', 'Discount updated successfully.');
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Error updating discount: '.$e->getMessage());
        }

        return redirect()->to('/discount');
    }

    /**
     * Soft delete discount
     */
   public function delete()
{

    if ($this->request->getMethod() == 'post') {
        return redirect()->to('/discount');
    }

    $id = $this->request->getPost('id');

    if (! $id) {
        return redirect()->to('/discount')
            ->with('error', 'Invalid Discount ID');
    }

    // Soft delete using the model
    $this->discountModel->softDeleteDiscount($id);

    return redirect()->to('/discount')
        ->with('success', 'Discount deleted successfully!');
}


}
