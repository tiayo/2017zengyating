<?php

$this->group(['namespace' => 'Home'], function () {
    $this->get('/', function () {
        return redirect()->route('manage');
    });
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
    $this->post('register', 'Auth\RegisterController@register')->name('home.register');
    $this->post('login', 'Auth\LoginController@login');
    $this->get('logout', 'Auth\LoginController@logout')->name('home.logout');

    //登陆后才可以访问
    $this->group(['middleware' => 'auth'], function () {

    });
});


