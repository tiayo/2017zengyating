<?php

$this->group(['namespace' => 'Manage', 'prefix' => 'manage'], function () {
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('manage.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('manage.logout');

    //登陆后才可以访问
    $this->group(['middleware' => 'manage_auth'], function () {

        //首页
        $this->get('/', 'IndexController@index')->name('manage');

        //预约相关（普通用户）
        $this->get('/manager_order/list/', 'OrderController@managerListView')->name('manager_order_list');
        $this->get('/manager_order/list/{keyword}', 'OrderController@managerListView')->name('manager_order_search');
        $this->get('/order/status/{order_id}/{status}', 'OrderController@changeStatus')->name('order_status');

        //管理员才可以操作
        $this->group(['middleware' => 'admin'], function () {
            //理发师相关
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

            //商品相关
            $this->get('/commodity/list/', 'CommodityController@listView')->name('commodity_list');
            $this->get('/commodity/list/{keyword}', 'CommodityController@listView')->name('commodity_search');
            $this->get('/commodity/add', 'CommodityController@addView')->name('commodity_add');
            $this->post('/commodity/add', 'CommodityController@post');
            $this->get('/commodity/update/{id}', 'CommodityController@updateView')->name('commodity_update');
            $this->post('/commodity/update/{id}', 'CommodityController@post');
            $this->get('/commodity/destroy/{id}', 'CommodityController@destroy')->name('commodity_destroy');

            //预约相关（管理员）
            $this->get('/order/list/', 'OrderController@listView')->name('order_list');
            $this->get('/order/list/{keyword}', 'OrderController@listView')->name('order_search');
            $this->get('/order/update/{id}', 'OrderController@updateView')->name('order_update');
            $this->post('/order/update/{id}', 'OrderController@post');
            $this->get('/order/destroy/{id}', 'OrderController@destroy')->name('order_destroy');

            //门店管理相关
            $this->get('/store/list/', 'StoreController@listView')->name('store_list');
            $this->get('/store/list/{keyword}', 'StoreController@listView')->name('store_search');
            $this->get('/store/add', 'StoreController@addView')->name('store_add');
            $this->post('/store/add', 'StoreController@post');
            $this->get('/store/update/{id}', 'StoreController@updateView')->name('store_update');
            $this->post('/store/update/{id}', 'StoreController@post');
            $this->get('/store/destroy/{id}', 'StoreController@destroy')->name('store_destroy');
        });
    });
});


