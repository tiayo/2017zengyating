<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\OrderService;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $order;
    protected $manage;
    protected $commodity;
    protected $request;

    public function __construct(OrderService $order,
                                ManagerService $manage,
                                CommodityService $commodity,
                                Request $request)
    {
        $this->order = $order;
        $this->manage = $manage;
        $this->commodity = $commodity;
        $this->request = $request;
    }

    /**
     * 预约理发师
     *
     * @param $manager_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order($manager_id)
    {
        //获取理发师信息
        $manager = $this->manage->first($manager_id);

        //获取服务项目
        $commodities = $this->commodity->getSimple('id', 'name');

        return view('home.manager.order', [
            'manager' => $manager,
            'commodities' => $commodities,
        ]);
    }

    /**
     * 取消订单
     *
     * @param $order_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderCancel($order_id)
    {
        $this->order->changeStatus($order_id, 5);

        return redirect()->route('home_user');
    }

    /**
     * 添加预约
     *
     * @param $manager_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function addPost($manager_id)
    {
        $this->validate($this->request, [
            'commodity' => 'required|array',
            'commodity.*' => 'required|integer',
            'order_time' => 'required|date|after:'.Carbon::now()->addMinute(60)->toDateTimeString(),
        ]);

        //获取所有post数据
        $post = $this->request->all();

        //构造参数
        $data['commodity'] = $post['commodity'];
        $data['manager_id'] = $manager_id;
        $data['order_time'] = $post['order_time'];

        //进行操作
        try {
            $this->order->updateOrCreate($data);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('home_user');
    }
}