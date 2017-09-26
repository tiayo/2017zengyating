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
    protected $manager;

    public function __construct(StoreService $store,
                                Request $request,
                                ManagerService $manager)
    {
        $this->store = $store;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $num = config('site.list_num');

        //按照分页获取店铺
        $stores = $this->store->get($num, $keyword);

        return view('home.store.list', [
            'lists' => $stores,
        ]);
    }

    public function view($store_id)
    {
        $store = $this->store->first($store_id);

        //根据店铺获取理发师
        $managers = $this->manager->getByStore($store_id);

        return view('home.store.view', [
            'store' => $store,
            'managers' => $managers,
        ]);
    }
}