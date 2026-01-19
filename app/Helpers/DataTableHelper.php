<?php

namespace App\Helpers;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;

class DataTableHelper
{
    protected IncomingRequest $request;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
    }

    public function getParams(array $columns): array
    {
        $draw   = (int) $this->request->getPost('draw');
        $start  = (int) $this->request->getPost('start');
        $length = (int) $this->request->getPost('length');

        $search = $this->request->getPost('search')['value'] ?? '';

        $orderIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDir   = $this->request->getPost('order')[0]['dir'] ?? 'asc';

        $orderColumn = $columns[$orderIndex] ?? $columns[0];

        return [
            'draw'        => $draw,
            'start'       => $start,
            'length'      => $length,
            'search'      => $search,
            'orderColumn' => $orderColumn,
            'orderDir'    => $orderDir,
        ];
    }
}

