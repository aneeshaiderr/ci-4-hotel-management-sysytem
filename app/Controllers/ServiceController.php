<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ServiceModel;
use Config\Services;
use App\Helpers\DataTableHelper;
class ServiceController extends BaseController
{
    protected ServiceModel $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();

        $this->request   = Services::request();

    }
    public function index()
    {


       return $this->render('Dashboard/Services/services');
    }

public function DataTable()
{

    $dt = new DataTableHelper($this->request);




    $columns = ['id','service_name','price','status'];

    $params = $dt->getParams($columns);

    $data = $this->serviceModel->getServices(
        $params['length'],
        $params['start'],
        $params['search'],
        $params['orderColumn'],
        $params['orderDir']
    );

      return $this->response->setJSON([
        'draw'            => $params['draw'],
        'recordsTotal'    => $this->serviceModel->countAll(),
        'recordsFiltered' => $this->serviceModel->countFiltered($params['search']),
        'data'            => $data
    ]);

}

    public function create()
    {
        return $this->render('Dashboard/Services/create');
    }


   public function store()
    {
        $request = Services::request();
        if ($request->getMethod() == 'post') {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method'
        ]);
    }
        $data = [
            'service_name' => $request->getPost('service_name'),
            'price'        => $request->getPost('price'),
            'status'       => $request->getPost('status')
        ];

        try {
            $this->serviceModel->insert($data);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Service created successfully!'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
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
        $request = Services::request();
        if ($request->getMethod() == 'post') {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request method']);
    }

        $id = $request->getPost('id');
        $data = [
        'service_name' => $request->getPost('service_name'),
        'price' => $request->getPost('price'),
        'status' => $request->getPost('status'),
    ];

    try {
        $this->serviceModel->updateService($id, $data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Service updated successfully']);
    } catch (\Exception $e) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong!']);
    }
}
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
            'message' => 'Service ID missing'
        ]);
    }



         if ($this->serviceModel->delete($id)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Service deleted successfully'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Delete failed'
    ]);
}


}
