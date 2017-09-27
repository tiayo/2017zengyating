<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('can')) {
    /**
     * 权限验证
     * 全局辅助函数
     *
     * @param $option
     * @param null $class
     * @param string $guard
     * @return mixed
     */
    function can($option, $class = null, $guard = '')
    {
        $user = Auth::guard($guard)->user();

        $class = $class ?? $user;

        if (empty($user)) {
            return false;
        }

        return $user->can($option, $class);
    }
}