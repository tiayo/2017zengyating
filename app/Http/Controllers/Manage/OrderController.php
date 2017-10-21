<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use App\Services\Manage\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * 管理员列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $num = config('site.list_num');

        $orders = $this->order->get($num, $keyword);

        return view('manage.order.list', [
            'lists' => $orders,
            'search_url' => route('order_search', ['keyword' => '']),
            'sign' => 'admin',
        ]);
    }

    /**
     * 理发师列表
     *
     * @param $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function managerListView($keyword = null)
    {
        $num = config('site.list_num');

        $orders = can('admin', null, 'manager') ?
            $this->order->get($num, $keyword) :
            $this->order->managerGet($num, $keyword);

        return view('manage.order.list', [
            'lists' => $orders,
            'search_url' => route('manager_order_search', ['keyword' => '']),
            'sign' => 'manager',
        ]);
    }

    /**
     * 修改状态
     *
     * @param $order_id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus($order_id, $status)
    {
        try {
            $this->order->changeStatus($order_id, $status);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('order_list');
    }

    /**
     * 修改管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateView($id)
    {
        //获取可预约的理发师
        $managers = $this->manager->getAvailable('id', 'name');

        //获取商品
        $commodities = $this->commodity->getSimple('id', 'name');

        try {
            $old_input = $this->request->session()->has('_old_input') ?
                session('_old_input') : $this->order->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.order.add_or_update', [
            'managers' => $managers,
            'commodities' => $commodities,
            'old_input' => $old_input,
            'url' => Route('order_update', ['id' => $id]),
            'sign' => 'update',
        ]);
    }

    /**
     * 添加/更新提交
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($id = null)
    {
        $this->validate($this->request, [
            'commodity' => 'required|array',
            'commodity.*' => 'required|integer',
            'manager_id' => 'required|integer',
            'order_time' => 'required|date|after:'.Carbon::now()->addMinute(60)->toDateTimeString(),
        ]);

        try {
            $this->order->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('order_list');
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        try {
            $this->order->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('order_list');
    }
}