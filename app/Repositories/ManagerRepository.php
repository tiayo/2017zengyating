<?php

namespace App\Repositories;

use App\Manager;

class ManagerRepository
{
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function create($data)
    {
        return $this->manager->create($data);
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
        return $this->manager
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
        return $this->manager
            ->where(function ($query) use ($keyword) {
                $query->where('managers.name', 'like', "%$keyword%")
                    ->orwhere('managers.email', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }
    
    public function first($id)
    {
        return $this->manager->find($id);
    }

    public function superId()
    {
        return $this->manager
            ->where('name', config('site.admin_name'))
            ->first();
    }

    public function destroy($id)
    {
        return $this->manager
            ->where('id', $id)
            ->delete();
    }

    public function countGroup($group_id)
    {
        return $this->manager
            ->where('group', $group_id)
            ->count();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->manager
            ->select($select)
            ->where($where)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->manager
            ->where('id', $id)
            ->update($data);
    }
}