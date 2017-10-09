<?php

//密码
$this->get('password', function (){
   return bcrypt('123456');
});

//验证码
$this->get('/captcha/{group}', 'CaptchaController@captcha')->name('captcha');

$this->group(['namespace' => 'Home'], function () {

    $this->get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
    $this->post('register', 'Auth\RegisterController@register')->name('home.register');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('home.logout');

    //登陆后才可以访问
    $this->group(['middleware' => 'home_auth'], function () {

    });
});


