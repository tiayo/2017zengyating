<?php

namespace App\Services\Manage;

use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $order;
    protected $commodity;

    public function __construct(OrderRepository $order, CommodityService $commodity)
    {
        $this->order = $order;
        $this->commodity = $commodity;
    }

    /**
     * 通过id验证记录是否存在以及是否有操作权限
     * 通过：返回该记录
     * 否则：抛错
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function validata($id)
    {
        $salesman = $this->order->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        return $salesman;
    }

    /**
     * 获取需要的数据(管理员级别)
     *
     * @return mixed
     */
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->order->getSearch($num, $keyword);
        }

        return $this->order->get($num);
    }

    /**
     * 获取需要的数据(理发师级别)
     *
     * @return mixed
     */
    public function managerGet($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->order->getSearch($num, $keyword);
        }

        return $this->order->managerGet($num);
    }

    /**
     * 查找指定id的用户
     *
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->validata($id);
    }

    /**
     * 更新或编辑
     *
     * @param $post
     * @param null $id
     * @return mixed
     */
    public function updateOrCreate($post, $id = null)
    {
        //统计数据
        $data['user_id'] = Auth::guard('web')->id();
        $data['commodity'] = serialize($post['commodity']);
        $data['manager_id'] = $post['manager_id'];
        $data['order_time'] = $post['order_time'];

        //总积分\总价格
        $value = $this->commodity->getValue($post['commodity']);
        $data['score'] = $value['score'];
        $data['price'] = $value['price'];

        //执行插入或更新
        return empty($id) ? $this->order->create($data) : $this->order->update($id, $data);
    }

    /**
     * 删除管理员
     *
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        //验证是否可以操作当前记录
        $this->validata($id)->toArray();

        //执行删除
        return $this->order->destroy($id);
    }

    public function countGroup($group_id)
    {
        return $this->order->countGroup($group_id);
    }
}