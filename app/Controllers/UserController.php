<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use App\Libraries\UserInfoLibrary;
 use App\Helpers\DataTableHelper;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

    }

    public function index()
    {
        $user = auth()->user();
         return $this->render('Dashboard/User/index');
        if ($user->inGroup('staff'))
             {
            $this->render('dashboard/staff/staff', [
                'users' => $this->userModel->findAll(),
            ]);
        }
        // Normal user
       $this->render('dashboard/user/user', [
            'user'               => $user,
            'currentReservation' => $this->userModel
                ->getCurrentReservation($user->id),
        ]);
    }
   public function datatable()
    {
        $dt = new DataTableHelper($this->request);
        $columns = ['username','first_name','last_name','email'];
        $params = $dt->getParams($columns);
        $data =$this->userModel->getUsers(
        $params['length'],
        $params['start'],
        $params['search'],
        $params['orderColumn'],
        $params['orderDir']
    );

    return $this->response->setJSON([
        'draw'            => $params['draw'],
        'recordsTotal'    => $this->userModel->countAllUsers(),
        'recordsFiltered' => $this->userModel->countFilteredUsers($params['search']),
        'data'            => $data
    ]);

    }

    public function create()
    {
        return $this->render('Dashboard/User/create');
    }

    /**
     * Store new user in users + auth_logins tables
     */
    public function store()
{
    $validation = Services::validation();

    $validation->setRules([
        'username'   => 'required|min_length[3]',
        'first_name' => 'required',
        'last_name'  => 'required',
        'contact_no' => 'permit_empty|numeric',
        'email'      => 'required|valid_email',
        'password'   => 'required|min_length[6]',
    ]);

    // Run validation
    if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setJSON([
            'status' => 'validation',
            'errors' => $validation->getErrors()
        ]);
    }

    // Prepare data
       $data = [
        'username'   => $this->request->getPost('username'),
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'contact_no' => $this->request->getPost('contact_no'),
        'email'      => $this->request->getPost('email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ];

    try {
        // Save user
        $userId = $this->userModel->createUser($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'User created successfully!',
            'user_id' => $userId
        ]);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
}

     public function edit( $id)
    {
        $user = $this->userModel->getUserWithInfo($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found');
        }

        return $this->render('Dashboard/User/edit', ['user' => $user]);
    }

    /**
     * Update user info
     */
     public function update()
{
     $validation = Services::validation();

     $validation->setRules([
        'username'   => 'required|min_length[3]',
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|valid_email',
    ]);

    if (!$validation->withRequest($this->request)->run()) {

        return $this->response->setJSON([
            'status' => 'validation',
            'errors' => $validation->getErrors(),
        ]);
    }

    $id = (int) $this->request->getPost('id');

    if (!$id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'User ID is required.'
        ]);
    }

    $data = [
        'username'   => $this->request->getPost('username'),
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('email'),
    ];

    try {
        $success = $this->userModel->updateUserWithInfo($id, $data);

        if ($success) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User updated successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to update user'
            ]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Server error: ' . $e->getMessage()
        ]);
    }
}


  // Soft delete user

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
            'message' => 'user ID missing'
        ]);
    }
    if ( $this->userModel->softDeleteUser($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Delete failed'
    ]);
}
}
