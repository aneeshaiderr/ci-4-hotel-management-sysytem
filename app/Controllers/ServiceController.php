<?php

namespace App\Controllers;
// use App\Controllers\ServicesController;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ServiceModel;
use Config\Services;

class ServiceController extends BaseController
{
    protected ServiceModel $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();

        $this->session   = Services::session();
        $this->request   = Services::request();

    }


    public function index()
    {
        $data['services'] = $this->serviceModel->getAllServicesList();

       return $this->render('Dashboard/Services/services', $data);
    }


    public function create()
    {
        return $this->render('Dashboard/Services/create');
    }


    public function store()
    {
        if ($this->request->getMethod() == 'post') {
            return redirect()->to('/services');
        }

        $rules = [
            'service_name' => 'required|min_length[3]',
            'price'        => 'required|numeric',
            'status'       => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            $this->serviceModel->createService([
                'service_name' => $this->request->getPost('service_name'),
                'price'        => $this->request->getPost('price'),
                'status'       => $this->request->getPost('status'),
            ]);

            return redirect()->to('/services')
                ->with('success', 'Service created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    public function edit($id = null)
    {
        if (! $id) {
            return redirect()->to('/services');
        }

        $service = $this->serviceModel->getById($id);

        if (! $service) {
            return redirect()->to('/services')
                ->with('error', 'Service not found!');
        }

        return $this->render('Dashboard/Services/edit', [
            'service' => $service,
        ]);
    }

    public function update()
    {
        if ($this->request->getMethod() == 'post') {
            return redirect()->to('/services');
        }

        $id = $this->request->getPost('id');

        if (! $id) {
            return redirect()->to('/services')
                ->with('error', 'Service ID missing!');
        }

        $rules = [
            'service_name' => 'required|min_length[3]',
            'price'        => 'required|numeric',
            'status'       => 'required|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->serviceModel->updateService($id, [
            'service_name' => $this->request->getPost('service_name'),
            'price'        => $this->request->getPost('price'),
            'status'       => $this->request->getPost('status'),
        ]);

        return redirect()->to('/services')
            ->with('success', 'Service updated successfully!');
    }



    public function delete()
    {
        if ($this->request->getMethod() == 'post') {
            return redirect()->to('/services');
        }

        $id = $this->request->getPost('id');

        if (! $id) {
            return redirect()->to('/services')
                ->with('error', 'Invalid Service ID');
        }

        $this->serviceModel->softDeleteService($id);

        return redirect()->to('/services')
            ->with('success', 'Service deleted successfully!');
    }
}


