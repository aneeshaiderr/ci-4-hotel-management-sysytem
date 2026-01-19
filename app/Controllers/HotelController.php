<?php
namespace App\Controllers;
use App\Models\HotelModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Helpers\DataTableHelper;
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


        return $this->render('Dashboard/Hotel/hotel');
    }
public function DataTable()
{
   $dt = new DataTableHelper($this->request);

    $columns = ['id','hotel_name','address','contact_no'];
  $params = $dt->getParams($columns);

    $data = $this->hotelModel->getHotels(
        $params['length'],
        $params['start'],
        $params['search'],
        $params['orderColumn'],
        $params['orderDir']
    );

 return $this->response->setJSON([
        'draw'            => $params['draw'],
        'recordsTotal'    => $this->hotelModel->countAllHotels(),
        'recordsFiltered' => $this->hotelModel->countFilteredHotels($params['search']),
        'data'            => $data
    ]);

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
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }

    $data = [
        'hotel_name' => $request->getPost('hotel_name'),
        'address'    => $request->getPost('address'),
        'contact_no' => $request->getPost('contact_no'),
    ];

    try {
        $this->hotelModel->createHotel($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Hotel created successfully!'
        ]);

    } catch (\Exception $e) {
        $errorMessage = 'Something went wrong!';
        if (strpos($e->getMessage(), '1062') !== false) {
            $errorMessage = 'Hotel already exists!';
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => $errorMessage
        ]);
    }
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

    if (!$request->isAJAX() || $request->getMethod() == 'post') {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }

    $id = $request->getPost('id');
    $data = [
        'hotel_name' => $request->getPost('hotel_name'),
        'address'    => $request->getPost('address'),
        'contact_no' => $request->getPost('contact_no')
    ];

    try {
        $this->hotelModel->updateHotel($id, $data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Hotel updated successfully!'
        ]);

    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
    /**
     * Soft delete hotel
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
            'message' => 'hotel ID missing'
        ]);
    }



    if ( $this->hotelModel->softDeleteHotel($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Hotel deleted successfully'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Delete failed'
    ]);
}
}
