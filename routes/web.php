<?php

$this->group(['namespace' => 'Home'], function () {

    $this->get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
    $this->post('register', 'Auth\RegisterController@register')->name('home.register');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('home.logout');

    //门店相关
    $this->get('/', 'StoreController@listView')->name('home_store_list');
    $this->get('/store/list/{keyword}', 'StoreController@listView')->name('home_store_search');

    //登陆后才可以访问
    $this->group(['middleware' => 'auth'], function () {
        //预约页面
        $this->get('order/{id}', 'ManagerController@order');
    });
});


