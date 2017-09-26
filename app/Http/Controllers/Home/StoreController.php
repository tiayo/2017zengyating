<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Manage\ManagerService;
use App\Services\Manage\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $store;
    protected $request;

    public function __construct(StoreService $store, Request $request)
    {
        $this->store = $store;
        $this->request = $request;
    }

    /**
     * 管理员列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $num = config('site.list_num');

        $stores = $this->store->get($num, $keyword);

        return view('home.store.list', [
            'lists' => $stores,
        ]);
    }
}