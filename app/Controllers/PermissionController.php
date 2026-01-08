<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PermissionModel;

class PermissionController extends BaseController
{
    protected PermissionModel $permissionModel;

    public function __construct()
    {
        $this->permissionModel = new PermissionModel();
    }

    /**
     * List all permissions
     */
    public function index()
    {
        $permissions = $this->permissionModel->getAll();
        $permissions = $this->permissionModel->findAll();
        return $this->render('Dashboard/User/permission', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show form to assign permission
     */
    public function create()
    {
        $users = $this->permissionModel->getUsers();

        return $this->render('Dashboard/User/createPermission', [
            'users' => $users
        ]);
    }

    /**
     * Store permission for user
     */
    public function store()
    {
        $userId = $this->request->getPost('user_id');
        $permission = trim($this->request->getPost('permission'));

        if (!$userId || $permission === '') {
            return redirect()->back()->with('error', 'All fields are required');
        }

        if ($this->permissionModel->exists($userId, $permission)) {
            return redirect()->back()->with('error', 'Permission already assigned to this user');
        }

        $this->permissionModel->assign($userId, $permission);

        return redirect()->to(base_url('permission'))
            ->with('success', 'Permission assigned successfully');
    }

    /**
     * Delete permission
     */
    public function delete()
{
    $id = $this->request->getPost('id');

    if (!$id) {
        return redirect()->back()->with('error', 'Invalid permission ID');
    }

    // Call model to remove
    $deleted = $this->permissionModel->remove($id);

    if ($deleted) {
        return redirect()->back()->with('success', 'Permission removed successfully');
    }

    return redirect()->back()->with('error', 'Failed to delete permission');
}
}

