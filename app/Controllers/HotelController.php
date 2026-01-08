<?php
namespace App\Controllers;
use App\Models\HotelModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class HotelController extends BaseController
{
    protected $hotelModel;
      public function __construct()
    {

         $this->hotelModel = model(HotelModel::class);
        $this->session    = Services::session();
    }

   public function index()
    {
        $hotels = $this->hotelModel->getAllHotels();

        return $this->render('Dashboard/Hotel/hotel', ['hotels' => $hotels]);
    }

    /**
     * Show create hotel form
     */
    public function create()
    {
         return $this->render('dashboard/Hotel/create');
    }

    /**
     * Store new hotel
     */
   public function store()
{

    $request = Services::request();
    $session = Services::session();




    if ($request->getMethod() == 'post') {
        return redirect()->to(base_url('hotel'));
    }

    $data = [
        'hotel_name' => $request->getPost('hotel_name'),
        'address'    => $request->getPost('address'),
        'contact_no' => $request->getPost('contact_no'),
    ];

    try {
        $this->hotelModel->createHotel($data);
        $session->setFlashdata('success', 'Hotel created successfully!');
    } catch (\Exception $e) {

        if (strpos($e->getMessage(), '1062') !== false) {
            $session->setFlashdata('error', 'Hotel already exists!');
        } else {
            $session->setFlashdata('error', 'Something went wrong!');
        }
    }


    return redirect()->to(base_url('hotel'));
}
    /**
     * Show hotel detail for edit
     */
    public function edit($id = null)
    {
        $request = Services::request();

        if (!$id && $request->getGet('id')) {
            $id = (int) $request->getGet('id');
        }

        $hotel = $this->hotelModel->getHotelById($id);

        if (!$hotel) {
            $this->session->setFlashdata('error', 'Hotel details not found.');
            return redirect()->to('/hotel');
        }

        return $this->render('dashboard/Hotel/edit', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * Update existing hotel
     */
    public function update()
    {
        $request = Services::request();

        if ($request->getMethod() !== 'post') {
            $id = $request->getPost('id');

            $data = [
                'hotel_name' => $request->getPost('hotel_name'),
                'address'    => $request->getPost('address'),
                'contact_no' => $request->getPost('contact_no'),
            ];

            try {
                $this->hotelModel->updateHotel($id, $data);
                $this->session->setFlashdata('success', 'Hotel updated successfully!');
            } catch (\Exception $e) {
                $this->session->setFlashdata('error', 'Something went wrong!');
            }

            return redirect()->to('/hotel');
        }
    }

    /**
     * Soft delete hotel
     */
    public function delete()
    {
        $request = Services::request();

        $id = $request->getPost('id');

        if (!$id) {
            $this->session->setFlashdata('error', 'Invalid hotel ID!');
            return redirect()->to('/hotel');
        }

        $this->hotelModel->softDeleteHotel($id);
        $this->session->setFlashdata('success', 'Hotel deleted successfully!');

        return redirect()->to('/hotel');
    }
}
