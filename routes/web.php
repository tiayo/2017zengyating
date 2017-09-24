<?php

$this->group(['namespace' => 'Manage', 'prefix' => 'manage'], function () {
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('manage.login');
    $this->post('login', 'Auth\LoginController@login');
});