<?php

namespace App\Repositories;

use App\Order;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function create($data)
    {
        return $this->order->create($data);
    }

    /**
     * 获取所有显示记录（过滤管理员）
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
     * 获取显示的搜索结果（超级管理员级）
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword)
    {
        return $this->order
            ->where(function ($query) use ($keyword) {
                $query->where('orders.name', 'like', "%$keyword%")
                    ->orwhere('orders.email', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }
    
    public function first($id)
    {
        return $this->order->find($id);
    }

    public function superId()
    {
        return $this->order
            ->where('name', config('site.admin_name'))
            ->first();
    }

    public function destroy($id)
    {
        return $this->order
            ->where('id', $id)
            ->delete();
    }

    public function countGroup($group_id)
    {
        return $this->order
            ->where('group', $group_id)
            ->count();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->order
            ->select($select)
            ->where($where)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->order
            ->where('id', $id)
            ->update($data);
    }
}