<?php

namespace App\Repositories;

use App\Manager;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Auth;

class StoreRepository
{
    protected $store;
    protected $user;
    protected $manager;

    public function __construct(Store $store, User $user, Manager $manager)
    {
        $this->store = $store;
        $this->user = $user;
        $this->manager = $manager;
    }

    public function create($data)
    {
        return $this->store->create($data);
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
        return $this->store
            ->orderBy('id', 'desc')
            ->paginate($num);
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
        return $this->store
            ->where('name', 'like', "%$keyword%")
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取所有显示记录(简易)
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->store
            ->select($select)
            ->orderBy('id', 'desc')
            ->get();
    }


    public function first($id)
    {
        return $this->store->find($id);
    }

    public function destroy($id)
    {
        return $this->store
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->store
            ->select($select)
            ->where($where)
            ->first();
    }

    public function count($where)
    {
        return $this->store
            ->where($where)
            ->count();
    }

    public function update($id, $data)
    {
        return $this->store
            ->where('id', $id)
            ->update($data);
    }
}