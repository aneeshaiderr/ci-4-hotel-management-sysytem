<?php

namespace App\Controllers;

class News extends BaseController
{
    public function index(): string
    {
        return view('Frontend/news');
    }
}
