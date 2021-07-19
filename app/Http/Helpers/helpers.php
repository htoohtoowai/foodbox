<?php

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

if (!function_exists('changeLanguage')) {
    function changeLanguage($request, $en, $mm)
    {
        $language = $request->header('Content-Language');
        if ($language == 'mm' && $mm != null) {
            $lang = $mm;
        }else {
            $lang = $en;
        }
        return $lang;
    }
}


