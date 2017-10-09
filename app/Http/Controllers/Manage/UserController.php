<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    protected $request;

    public function __construct(UserService $user, Request $request)
    {
        $this->user = $user;
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

        $users = $this->user->get($num, $keyword);

        return view('manage.user.list', [
            'lists' => $users,
        ]);
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
            $this->user->destroy($id);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        return redirect()->route('user_list');
    }
}