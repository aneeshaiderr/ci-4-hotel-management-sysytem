<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
// use CodeIgniter\Exceptions\PageForbiddenException;

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
 $users = $this->userModel->getAllUsers();
        // Load view
         return $this->render('Dashboard/User/index', ['users' => $users]);

        // if ($user->inGroup('super_admin')) {
        //     return view('dashboard/user/index', [
        //         'users' => $this->userModel->findAll(),
        //     ]);
        // }
//   return view('layout/dashboard', ['content' => $content]);
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
                // ->getCurrentReservation($user->id),
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
    $validation = \Config\Services::validation();

    $validation->setRules([
        'username'   => 'required|min_length[3]',
        'identifier' => 'required|valid_email',
        'password'   => 'required|min_length[6]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return view('Dashboard/User/create', [
            'validation' => $validation
        ]);
    }

    $data = [
        'username'   => $this->request->getPost('username'),
        'identifier' => $this->request->getPost('identifier'),
        'password'   => $this->request->getPost('password'),
    ];

    $userId = $this->userModel->createUser($data);

    return redirect()->to('/user')->with('success', 'User created successfully');
}
    public function edit($id = null)
    {

        $id ??= auth()->id();

        $user = $this->userModel->find($id);

        if (! $user) {
            return redirect()
                ->to('/user')
                ->with('error', 'User not found');
        }

        return view('dashboard/user/editUser', [
            'user' => $user,
        ]);
    }

    public function delete()
    {


        $id = $this->request->getPost('id');

        $this->userModel->delete($id);

        return redirect()
            ->to('/user')
            ->with('success', 'User deleted successfully');
    }
}
