<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use App\Services\Manage\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $order;
    protected $request;
    protected $manager;
    protected $commodity;

    public function __construct(OrderService $order,
                                Request $request,
                                ManagerService $manager,
                                CommodityService $commodity)
    {
        $this->order = $order;
        $this->request = $request;
        $this->manager = $manager;
        $this->commodity = $commodity;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView()
    {
        $orders = $this->order->userGet();

        return view('home.user.list', [
            'lists' => $orders,
            'user' => Auth::guard()->user()
        ]);
    }
}