<?php

use Laravel\Sanctum\PersonalAccessToken;


if (! function_exists("user")) {
    function user()
    {
        try {
            [$id, $token] = explode('|', request()->header("authorization"));
            return PersonalAccessToken::findToken($token)->tokenable;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
