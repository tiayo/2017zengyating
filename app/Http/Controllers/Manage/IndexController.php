<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('manage.index.index');
    }
}