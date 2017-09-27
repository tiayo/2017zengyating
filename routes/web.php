<?php

$this->group(['namespace' => 'Home'], function () {

    $this->get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
    $this->post('register', 'Auth\RegisterController@register')->name('home.register');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('home.logout');

    //门店相关
    $this->get('/', 'StoreController@listView')->name('home.index');
    $this->get('/store/list/{keyword}', 'StoreController@listView')->name('home_store_search');
    $this->get('/store/view/{store_id}', 'StoreController@view')->name('home_store_view');

    //登陆后才可以访问
    $this->group(['middleware' => 'home_auth'], function () {
        //预约页面
        $this->get('order/{manager_id}', 'ManagerController@order')->name('home_order');
        $this->post('order/{manager_id}', 'ManagerController@addPost');
        $this->get('order/cancel/{order_id}', 'ManagerController@orderCancel')->name('home_order_cancle');

        //会员中心
        $this->get('user', 'UserController@listView')->name('home_user');
    });
});


