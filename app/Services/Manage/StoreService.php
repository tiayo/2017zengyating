<?php

namespace App\Services\Manage;

use App\Repositories\StoreRepository;
use App\Services\ImageService;
use Exception;

class StoreService
{
    use ImageService;

    protected $store;

    public function __construct(StoreRepository $store)
    {
        $this->store = $store;
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
        $salesman = $this->store->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        return $salesman;
    }

    /**
     * 获取需要的数据
     *
     * @param int $num
     * @param null $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->store->getSearch($num, $keyword);
        }

        return $this->store->get($num);
    }

    /**
     * 获取需要的数据
     *
     * @param array ...$select
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSimple(...$select)
    {
        return $this->store->getSimple(...$select);
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
        //构造数组
        $data['name'] = $post['name'];
        $data['address'] = $post['address'];
        $data['phone'] = $post['phone'];
        $data['description'] = $post['description'];

        //有上传图片时处理
        if (isset($post['avatar'])) {
            $data['avatar'] = $this->uploadImage($post['avatar']);
        }


        //执行插入或更新
        return empty($id) ? $this->store->create($data) : $this->store->update($id, $data);
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
        return $this->store->destroy($id);
    }

    /**
     * 按需求统计
     *
     * @param $where
     * @return mixed
     */
    public function count($where){
        return $this->store->count($where);
    }
}