<?php

namespace App\Repositories;

use App\Manager;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    protected $order;
    protected $user;
    protected $manager;

    public function __construct(Order $order, User $user, Manager $manager)
    {
        $this->order = $order;
        $this->user = $user;
        $this->manager = $manager;
    }

    public function create($data)
    {
        return $this->order->create($data);
    }

    /**
     * 获取所有显示记录（管理员级别）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num)
    {
        return $this->order
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取所有显示记录（理发师级别）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function managerGet($num)
    {
        return $this->order
            ->where('manager_id', Auth::guard('manager')->id())
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取所有显示记录（用户级别）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function userGet()
    {
        return $this->order
            ->where('user_id', Auth::guard()->id())
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取显示的搜索结果（管理员级）
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword)
    {
        $array = $this->user
                ->select('id')
                ->where('name', 'like', "%$keyword%")
                ->get()
                ->toArray();

        return $this->order
            ->where('manager_id', Auth::guard('manager')->id())
            ->whereIn('user_id', $array)
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取显示的搜索结果（理发师级）
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getManageSearch($num, $keyword)
    {
        $array = $this->manager
            ->select('id')
            ->where('name', 'like', "%$keyword%")
            ->get()
            ->toArray();

        return $this->order
            ->whereIn('manager_id', $array)
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 统计完成状态订单的金额总和
     *
     * @return mixed
     */
    public function sumPrice()
    {
        return $this->order
            ->where('status', '4')
            ->sum('price');
    }
    
    public function first($id)
    {
        return $this->order->find($id);
    }

    public function destroy($id)
    {
        return $this->order
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->order
            ->select($select)
            ->where($where)
            ->first();
    }

    public function count($where)
    {
        return $this->order
            ->where($where)
            ->count();
    }

    public function update($id, $data)
    {
        return $this->order
            ->where('id', $id)
            ->update($data);
    }
}