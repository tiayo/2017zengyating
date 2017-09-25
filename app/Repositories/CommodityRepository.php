<?php

namespace App\Repositories;

use App\Commodity;

class CommodityRepository
{
    protected $commodity;

    public function __construct(Commodity $commodity)
    {
        $this->commodity = $commodity;
    }

    public function create($data)
    {
        return $this->commodity->create($data);
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
        return $this->commodity
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
        return $this->commodity
            ->where(function ($query) use ($keyword) {
                $query->where('commodities.name', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }
    
    public function first($id)
    {
        return $this->commodity->find($id);
    }

    public function superId()
    {
        return $this->commodity
            ->where('name', config('site.admin_name'))
            ->first();
    }

    public function destroy($id)
    {
        return $this->commodity
            ->where('id', $id)
            ->delete();
    }

    public function countGroup($group_id)
    {
        return $this->commodity
            ->where('group', $group_id)
            ->count();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->commodity
            ->select($select)
            ->where($where)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->commodity
            ->where('id', $id)
            ->update($data);
    }
}