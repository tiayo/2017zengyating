<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\OrderService;
use App\Services\Manage\ManagerService;

class ManagerController extends Controller
{
    protected $order;
    protected $manage;

    public function __construct(OrderService $order, ManagerService $manage)
    {
        $this->order = $order;
        $this->manage = $manage;
    }

    public function order($id)
    {
        $manager = $this->manage->first($id);

        return view('home.manager.order', [
            'manager' => $manager,
        ]);
    }
}