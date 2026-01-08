<?php

namespace App\Controllers;
use App\Models\ReservationModel;
use App\Models\UserModel;
use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Models\DiscountModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReservationController extends BaseController
{
    protected $reservationModel;
    protected $userModel;
    protected $hotelModel;
    protected $roomModel;
    protected $discountModel;
    protected $session;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->userModel        = new UserModel();
        $this->hotelModel       = new HotelModel();
        $this->roomModel        = new RoomModel();
        $this->discountModel    = new DiscountModel();
        $this->session          = session();
    }

    /** List all reservations */
    public function index()
    {
        $userId = $this->session->get('user_id');


        $reservations = $this->reservationModel->getAllReservations($userId);

        return $this->render('Dashboard/Reservation/reservation', [
            'reservations' => $reservations,
        ]);
    }

    /** Show create reservation form */
    public function create()
    {

        return $this->render('dashboard/Reservation/create', [
            'users'     => $this->userModel->findAll(),
            'hotels'    => $this->hotelModel->findAll(),
            'rooms'     => $this->roomModel->getAllRooms(),
            'discounts' => $this->discountModel->findAll(),

        ]);
    }

    /** Store reservation */
    public function store()
    {
    $request = service('request');
    $session = session();

    $authId = $request->getPost('auth_id');

    if (!$authId) {
        $session->setFlashdata('error', 'Please select a user email.');
        return redirect()->back()->withInput();
    }

    // Get user_id from auth_identities
    // $authModel = new \App\Models\AuthIdentitiesModel();
    $authData = $authModel->find($authId);

    if (!$authData) {
        $session->setFlashdata('error', 'Invalid Auth Identity selected.');
        return redirect()->back()->withInput();
    }

    $userId = $authData['user_id'];

    $data = [
        'hotel_code' => $request->getPost('hotel_code'),
        'auth_id'    => $authId,
        'user_id'    => $userId,
        'hotel_id'   => $request->getPost('hotel_id'),
        'room_id'    => $request->getPost('room_id'),
        'discount_id'=> $request->getPost('discount_id') ?: null,
        'check_in'   => $request->getPost('check_in'),
        'check_out'  => $request->getPost('check_out'),
        'status'     => $request->getPost('status'),
    ];

    $reservationModel = new ReservationModel();
    $reservationModel->insert($data);

    $session->setFlashdata('success', 'Reservation created successfully!');
    return redirect()->to(base_url('/reservation'));
}

    /** Show edit form */
    public function edit($id)
    {
        $reservation = $this->reservationModel->find($id);

        if (!$reservation) {
            $this->session->setFlashdata('error', 'Reservation not found.');
            return redirect()->to('/reservation');
        }

        return $this->render('dashboard/Reservation/editReservation', [
            'reservation' => $reservation,
            'hotels'      => $this->hotelModel->findAll(),
            'rooms'       => $this->roomModel->getAllRooms(),
            'discounts'   => $this->discountModel->findAll(),
        ]);
    }

    /** Update reservation */
    public function update()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/reservation');
        }

        $id = $this->request->getPost('id');
        if (!$id) {
            $this->session->setFlashdata('error', 'Reservation ID is required.');
            return redirect()->to('/reservation');
        }

        $data = [
            'hotel_code'  => $this->request->getPost('hotel_code'),
            'user_id'     => $this->request->getPost('user_id'),
            'hotel_id'    => $this->request->getPost('hotel_id'),
            'room_id'     => $this->request->getPost('room_id'),
            'discount_id' => $this->request->getPost('discount_id') ?: null,
            'check_in'    => $this->request->getPost('check_in'),
            'check_out'   => $this->request->getPost('check_out'),
            'status'      => $this->request->getPost('status'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $this->reservationModel->update($id, $data);

        $this->session->setFlashdata('success', 'Reservation updated successfully.');
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

        return view('dashboard/Reservation/reservationDetail', [
            'reservation' => $reservation,
        ]);
    }
}
