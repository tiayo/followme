<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\Manage\CommodityService;
use App\Services\Manage\ManagerService;
use App\Services\Manage\OrderService;
use App\Services\Manage\StoreService;
use App\Services\Manage\UserService;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        return view('manage.index.index');
    }
}