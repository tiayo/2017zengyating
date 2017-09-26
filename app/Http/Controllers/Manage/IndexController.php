<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use App\Services\Manage\OrderService;
use App\Services\Manage\StoreService;
use App\Services\Manage\UserService;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(UserService $user,
                          StoreService $store,
                          ManagerService $manager,
                          OrderService $order)
    {
        $users = $user->get(10);

        return view('manage.index.index', [
            'store_count' => $store->count([['id', '>', 0]]),
            'manager_count' => $manager->count([['id', '>', 0]]),
            'order_count' => $order->count([['id', '>', 0]]),
            'user_count' => $user->count([['id', '>', 0]]),
            'today_count' => $order->count([
                ['order_time', '>=', Carbon::today()->format('Y-m-d 00:00:00')],
                ['order_time', '<', Carbon::tomorrow()->format('Y-m-d 00:00:00')]
            ]),
            'all_price' => $order->sumPrice(),
            'lists' => $users,
        ]);
    }
}