<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function index()
    {
        return view('./user/landing_page');
    }

        public function news()
    {
        return view('./user/news');
    }

    public function moodboard()
    {
        return view('./user/moodboard');
    }

    public function roadmap()
    {
        return view('./user/roadmap');
    }
}
