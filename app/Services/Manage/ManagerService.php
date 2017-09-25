<?php

namespace App\Services\Manage;

use App\Events\AddMessage;
use App\Repositories\ManagerRepository;
use Illuminate\Support\Facades\Auth;
use Exception;

class ManagerService
{
    protected $manager;

    public function __construct(ManagerRepository $manager)
    {
        $this->manager = $manager;
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
        $salesman = $this->manager->first($id);

        throw_if(empty($salesman), Exception::class, '未找到该记录！', 404);

        return $salesman;
    }

    /**
     * 获取需要的数据
     *
     * @return mixed
     */
    public function get($num = 10000, $keyword = null)
    {
        if (!empty($keyword)) {
            return $this->manager->getSearch($num, $keyword);
        }

        return $this->manager->get($num);
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
        //创建操作时
        if (empty($id)) {
            $data['name'] = $post['name'];
            $data['email'] = $post['email'];
        }

        //统计数据
        $data['phone'] = $post['phone'];
        $data['type'] = $post['type'];
        $data['introduce'] = $post['introduce'];

        //密码
        if (isset($post['password'])) {
            $data['password'] = bcrypt($post['password']);
        } else if(empty($id) && $id !== 0) {
            //默认密码
            $data['password'] = bcrypt('abcd8888');
        }

        //执行插入或更新
        return empty($id) ? $this->manager->create($data) : $this->manager->update($id, $data);
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
        $orgin = $this->validata($id)->toArray();

        //执行删除
        $this->manager->destroy($id);

        //执行写入消息事件
        return event(new AddMessage('salesman', 3, [], $orgin));
    }

    public function countGroup($group_id)
    {
        return $this->manager->countGroup($group_id);
    }
}