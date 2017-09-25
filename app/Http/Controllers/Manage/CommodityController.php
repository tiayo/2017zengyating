<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    protected $commodity;
    protected $request;

    public function __construct(CommodityService $commodity, Request $request)
    {
        $this->commodity = $commodity;
        $this->request = $request;
    }

    /**
     * 管理员列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listView($keyword = null)
    {
        $num = config('site.list_num');

        $commoditys = $this->commodity->get($num, $keyword);

        return view('manage.commodity.list', [
            'lists' => $commoditys,
        ]);
    }

    /**
     * 添加管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView()
    {
        return view('manage.commodity.add_or_update', [
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('commodity_add'),
            'sign' => 'add',
        ]);
    }

    /**
     * 修改管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateView($id)
    {
        try {
            $old_input = $this->request->session()->has('_old_input') ?
                session('_old_input') : $this->commodity->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.commodity.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('commodity_update', ['id' => $id]),
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
            'name' => 'required',
            'price' => 'required|numeric',
            'score' => 'required|max:2',
            'description' => 'required',
        ]);

        //创建动作时验证邮箱是否已经存在
        empty($id) ? $this->validate($this->request, [
            'name' => 'unique:commodities'
        ]) : true;

        try {
            $this->commodity->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('commodity_list');
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
            $this->commodity->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('commodity_list');
    }
}