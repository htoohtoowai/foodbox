<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('securityDecrypt')) {

    function securityDecrypt($token)
    {
        return (new Encrypter)->decrypt($token);
    }
}

if (!function_exists('securityEncrypt')) {

    function securityEncrypt($token)
    {
        return (new Encrypter)->encrypt($token);
    }
}

if (!function_exists('activeSegment')) {

    function activeSegment($index, $path)
    {
        return request()->segment($index) == $path ? 'active' : '';
    }
}

if (!function_exists('activePath')) {

    function activePath($path = null)
    {
        $path = is_null($path)
            ? config('app.admin_prefix')
            : config('app.admin_prefix') . '/' . $path;

        return request()->is($path) ? 'active' : '';
    }
}

if (!function_exists('showSegment')) {

    function showSegment($index, $path)
    {
        return request()->segment($index) == $path ? 'show' : '';
    }
}


