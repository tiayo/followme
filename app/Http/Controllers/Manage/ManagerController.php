<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\ManagerService;
use App\Services\Manage\StoreService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $manager;
    protected $request;

    public function __construct(ManagerService $manager, Request $request)
    {
        $this->manager = $manager;
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

        $managers = $this->manager->get($num, $keyword);

        return view('manage.manager.list', [
            'lists' => $managers,
        ]);
    }

    /**
     * 添加管理员视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addView()
    {
        return view('manage.manager.add_or_update', [
            'old_input' => $this->request->session()->get('_old_input'),
            'url' => Route('manager_add'),
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
                session('_old_input') : $this->manager->first($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }

        return view('manage.manager.add_or_update', [
            'old_input' => $old_input,
            'url' => Route('manager_update', ['id' => $id]),
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
            'email' => 'required|email',
            'name' => 'required',
            'avatar' => 'file|image',
            'store_id' => 'required|integer',
            'phone' => 'required|numeric',
            'type' => 'required|max:2',
            'introduce' => 'required',
            'status' => 'required|integer|min:0|max:1',
            'password' => 'min:6',
        ]);

        //创建动作时验证邮箱是否已经存在
        empty($id) ? $this->validate($this->request, [
            'email' => 'unique:managers'
        ]) : true;

        try {
            $this->manager->updateOrCreate($this->request->all(), $id);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }

        return redirect()->route('manager_list');
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
            $this->manager->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('manager_list');
    }
}