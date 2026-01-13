<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RoomModel;
use Config\Services;
class RoomsController extends BaseController
{
   public function __construct()
    {
        // Initialize CI4 services
        $this->roomModel = model(RoomModel::class);
        $this->session   = Services::session();
        $this->request   = Services::request();
    }

    /**
     * List all rooms
     */
    public function index()
    {
        $rooms = $this->roomModel->getAllRooms();
        return $this->render('Dashboard/Rooms/room', ['rooms' => $rooms]);
    }

    /**
     * Show create room form
     */
    public function create()
    {
        $hotels = $this->roomModel->getAllHotels();

        return $this->render('dashboard/Rooms/create', [
            'hotels' => $hotels,
        ]);
    }

    /**
     * Store new room
     */
   public function store()
{

    // Check if it's a POST request
    // if ($this->request->getMethod() == 'post') {
    //     return redirect()->to(base_url('rooms'));
    // }
 if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request'
        ]);
    }
    // Get POST data
    $data = [
        'room_number' => $this->request->getPost('room_number'),
        'floor'       => $this->request->getPost('floor'),
        'beds'        => $this->request->getPost('beds'),
        'max_guests'  => $this->request->getPost('max_guests'),
        'hotel_id'    => $this->request->getPost('hotel_id'),
        'status'      => $this->request->getPost('status'),
    ];
 if (!$data['hotel_id']) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Please select hotel'
        ]);
    }

    $this->roomModel->create($data);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Room created successfully'
    ]);
    try {
        // Insert into DB
        $this->roomModel->create($data);
        $this->session->setFlashdata('success', 'Room created successfully!');
    } catch (\Exception $e) {
        $this->session->setFlashdata('error', 'Something went wrong: ' . $e->getMessage());
    }

    return redirect()->to(base_url('rooms'));
}
    /**
     * Show room details
     */
    public function show($id = null)
    {
        if (!$id) {
            $id = (int) $this->request->getGet('id');
        }

        $room = $this->roomModel->getRoomById($id);

        if (!$room) {
            $this->session->setFlashdata('error', 'Room details not found.');
            return redirect()->to(site_url('rooms'));
        }

        return $this->render('dashboard/Rooms/roomDetail', ['room' => $room]);
    }

    /**
     * Show edit room form
     */
    public function edit($id)
    {
        $room = $this->roomModel->getRoomById($id);

        if (!$room) {
            $this->session->setFlashdata('error', 'Room not found.');
            return redirect()->to(site_url('rooms'));
        }

        $hotels = $this->roomModel->getAllHotels();

        return $this->render('dashboard/Rooms/edit', [
            'room'   => $room,
            'hotels' => $hotels
        ]);
    }

    /**
     * Update room
     */
     public function update()
{

    $id = $this->request->getPost('id');
    if (!$id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Room ID is required'
        ]);
    }

    $data = [
        'room_number' => $this->request->getPost('room_number'),
        'floor'       => $this->request->getPost('floor'),
        'beds'        => $this->request->getPost('beds'),
        'max_guests'  => $this->request->getPost('max_guests'),
        'status'      => $this->request->getPost('status'),
    ];
// dd($data);
// exit();
    if ($this->roomModel->update($id, $data)) {
        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Room updated successfully'
        ]);
    }

    return $this->response->setJSON([
        'status'  => 'error',
        'message' => 'DB update failed'
    ]);
}
    /**
     * Delete (soft delete) room
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
            'message' => 'room ID missing'
        ]);
    }



    if ($this->roomModel->softDeleteRoom($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Room deleted successfully'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Delete failed'
    ]);
}
}
