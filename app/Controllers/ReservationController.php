<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\UserModel;
use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Models\DiscountModel;
use App\Models\UserInfoModel;
use App\Controllers\BaseController;
use App\Helpers\DataTableHelper;
class ReservationController extends BaseController
{
    protected $reservationModel;
    protected $userModel;
    protected $hotelModel;
    protected $roomModel;
    protected $discountModel;
    protected $userInfoModel;
    protected $session;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->userModel        = new UserModel();
        $this->hotelModel       = new HotelModel();
        $this->roomModel        = new RoomModel();
        $this->discountModel    = new DiscountModel();
        $this->userInfoModel    = new UserInfoModel();
        $this->session          = session();
    }

    /** List all reservations */
    public function index()
    {


        return $this->render('Dashboard/Reservation/reservation');
    }
 public function DataTable()
{

   $dt = new DataTableHelper($this->request);

    $columns = ['id','hotel_code','email','hotel_name','room_id','discount_name','check_in','check_out','status'];
    $params = $dt->getParams($columns);

    $data = $this->reservationModel->getReservations(
        $params['start'],
        $params['length'],
        $params['search'],
        $params['orderColumn'],
        $params['orderDir']
    );

    $recordsTotal = $this->reservationModel->countAllReservations();
    return $this->response->setJSON([
        'draw' => $params['draw'],
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $data['recordsFiltered'],
        'data' => $data['data']
    ]);
}
    /** Show create reservation form */
    public function create()
    {
        $emails = $this->userInfoModel->getAllEmails(); // get emails from user_info

        return $this->render('Dashboard/Reservation/create', [
            'users'     => $this->userModel->findAll(),
            'hotels'    => $this->hotelModel->findAll(),
            'rooms'     => $this->roomModel->getAllRooms(),
            'discounts' => $this->discountModel->findAll(),
            'emails'    => $emails,
        ]);
    }



    /** Store reservation */
public function store()
{
    $request = service('request');
    $session = session();

    // Validate input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'hotel_code'    => 'required',
        'user_info_id'  => 'required|numeric',
        'hotel_id'      => 'required|numeric',
        'room_id'       => 'required|numeric',
        'discount_id'   => 'permit_empty|numeric',
        'check_in'      => 'required|valid_date[Y-m-d]',
        'check_out'     => 'required|valid_date[Y-m-d]',
        'status'        => 'required',
    ]);

    if (!$validation->withRequest($request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Prepare data for insert
    $data = [
        'hotel_code'    => $request->getPost('hotel_code'),
        'user_info_id'  => (int) $request->getPost('user_info_id'), // mandatory FK
        'hotel_id'      => (int) $request->getPost('hotel_id'),
        'room_id'       => (int) $request->getPost('room_id'),
        'discount_id'   => $request->getPost('discount_id') ?: null,
        'check_in'      => $request->getPost('check_in'),
        'check_out'     => $request->getPost('check_out'),
        'status'        => $request->getPost('status'),
    ];

    // Insert into DB
    $reservationModel = new ReservationModel();
    $insertId = $reservationModel->insert($data);

    if ($insertId) {
        $session->setFlashdata('success', 'Reservation created successfully!');
        return redirect()->to('/reservation');
    } else {
        $session->setFlashdata('error', 'Failed to create reservation.');
        return redirect()->back()->withInput();
    }
}

    /** Show edit reservation form */
    public function edit($id)
    {
        $reservation = $this->reservationModel->find($id);

        if (!$reservation) {
            $this->session->setFlashdata('error', 'Reservation not found.');
            return redirect()->to('/reservation');
        }

        return $this->render('Dashboard/Reservation/edit', [
            'reservation' => $reservation,
            'hotels'      => $this->hotelModel->findAll(),
            'rooms'       => $this->roomModel->getAllRooms(),
            'discounts'   => $this->discountModel->findAll(),
        ]);
    }

    /** Update reservation */
  public function update()
{
    if ($this->request->getMethod() == 'post') {
        return redirect()->to('/reservation');
    }

    $id = (int) $this->request->getPost('id');
    if (!$id) {
        $this->session->setFlashdata('error', 'Reservation ID is required.');
        return redirect()->to('/reservation');
    }
    $userInfoId = (int) $this->request->getPost('user_info_id');

    if (!$userInfoId) {
        $this->session->setFlashdata('error', 'Please select user email.');
        return redirect()->back()->withInput();
    }

    $data = [
        'hotel_code'   => $this->request->getPost('hotel_code'),
        'user_info_id' => $userInfoId,
        'hotel_id'     => (int) $this->request->getPost('hotel_id'),
        'room_id'      => (int) $this->request->getPost('room_id'),
        'discount_id'  => $this->request->getPost('discount_id') ?: null,
        'check_in'     => $this->request->getPost('check_in'),
        'check_out'    => $this->request->getPost('check_out'),
        'status'       => $this->request->getPost('status'),
    ];

    if ($this->reservationModel->update($id, $data)) {
        $this->session->setFlashdata('success', 'Reservation updated successfully.');
    } else {
        $this->session->setFlashdata('error', 'Failed to update reservation.');
    }

    return redirect()->to('/reservation');
}

    /** Delete reservation (soft delete) */
    public function delete()
    {
        $hotelCode = $this->request->getPost('hotel_code');

        if (!$hotelCode) {
            $this->session->setFlashdata('error', 'Hotel code missing!');
            return redirect()->to('/reservation');
        }

        $this->reservationModel->where('hotel_code', $hotelCode)
                               ->set(['deleted_at' => date('Y-m-d H:i:s')])
                               ->update();

        $this->session->setFlashdata('success', 'Reservation deleted successfully.');
        return redirect()->to('/reservation');
    }

    /** Show reservation detail */
    public function show($id)
    {
        $reservation = $this->reservationModel->getReservationById($id);

        return view('Dashboard/Reservation/reservationDetail', [
            'reservation' => $reservation,
        ]);
    }
}
