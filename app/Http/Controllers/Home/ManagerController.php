<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function order($id)
    {
        return view('home.manager.order');
    }
}