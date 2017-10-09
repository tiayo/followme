<?php

$this->group(['namespace' => 'Manage', 'prefix' => 'manage'], function () {
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('manage.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('manage.logout');

    //登陆后才可以访问
    $this->group(['middleware' => 'manage_auth'], function () {

        //首页
        $this->get('/', 'IndexController@index')->name('manage');

        //管理员才可以操作
        $this->group(['middleware' => 'admin'], function () {
            //管理员相关
            $this->get('/manager/list/', 'ManagerController@listView')->name('manager_list');
            $this->get('/manager/list/{keyword}', 'ManagerController@listView')->name('manager_search');
            $this->get('/manager/add', 'ManagerController@addView')->name('manager_add');
            $this->post('/manager/add', 'ManagerController@post');
            $this->get('/manager/update/{id}', 'ManagerController@updateView')->name('manager_update');
            $this->post('/manager/update/{id}', 'ManagerController@post');
            $this->get('/manager/destroy/{id}', 'ManagerController@destroy')->name('manager_destroy');

            //会员相关
            $this->get('/user/list/', 'UserController@listView')->name('user_list');
            $this->get('/user/list/{keyword}', 'UserController@listView')->name('user_search');
            $this->get('/user/destroy/{id}', 'UserController@destroy')->name('user_destroy');
        });
    });
});


