<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiscountModel;
use Config\Services;
use App\Helpers\DataTableHelper;
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
        return $this->render('Dashboard/Discount/discount');
    }
    public function datatable()
{
    $dt = new DataTableHelper($this->request);
    $columns = [
        'id',
        'discount_type',
        'discount_name',
        'value',
        'start_date',
        'end_date',
        'status'
    ];

    $params = $dt->getParams($columns);

    $data = $this->discountModel->getDiscounts(
        $params['length'],
        $params['start'],
        $params['search'],
        $params['orderColumn'],
        $params['orderDir']
    );

    return $this->response->setJSON([
        'draw'            => $params['draw'],
        'recordsTotal'    => $this->discountModel->countAll(),
        'recordsFiltered' => $this->discountModel->countFiltered($params['search']),
        'data'            => $data
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
    $request = Services::request();

    if($request->getMethod() == 'post'){
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }

    $data = [
        'discount_type' => $request->getPost('discount_type'),
        'discount_name' => $request->getPost('discount_name'),
        'value' => $request->getPost('value'),
        'start_date' => $request->getPost('start_date'),
        'end_date' => $request->getPost('end_date'),
        'status' => $request->getPost('status')
    ];

    try {
        $this->discountModel->createDiscount($data); // Model method
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Discount created successfully!'
        ]);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Something went wrong!'
        ]);
    }
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
    $request = $this->request;

    if ($request->getMethod() == 'post') {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }

    $id = $request->getPost('id');
    if (!$id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Discount ID is required'
        ]);
    }

    $data = [
        'discount_type' => $request->getPost('discount_type'),
        'discount_name' => $request->getPost('discount_name'),
        'value'         => $request->getPost('value'),
        'start_date'    => $request->getPost('start_date'),
        'end_date'      => $request->getPost('end_date'),
        'status'        => $request->getPost('status'),
    ];

    try {
        $this->discountModel->updateDiscount($id, $data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Discount updated successfully'
        ]);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Error updating discount: '.$e->getMessage()
        ]);
    }
}

    /**
     * Soft delete discount
     */


  public function delete()
{
    if (! $this->request->isAJAX()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request'
        ]);
    }

    $id = $this->request->getPost('id');

    if (! $id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Discount ID missing'
        ]);
    }



    if ($this->discountModel->softDeleteDiscount($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Discount deleted successfully'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Delete failed'
    ]);
}

}
