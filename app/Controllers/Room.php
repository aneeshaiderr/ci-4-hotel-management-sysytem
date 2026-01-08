<?php

namespace App\Controllers;

class Room extends BaseController
{
    public function index(): string
    {
        return view('Frontend/room');
    }
}
