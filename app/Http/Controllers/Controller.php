<?php

namespace App\Http\Controllers;

use App\Models\UserCookie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function validateCookiePost($post)
    {
        $user_cookie = UserCookie::where("post_id", $post->id)->first();
        $cookie_name = $user_cookie->cookie_name;
        $cookie_value = $user_cookie->cookie_value;

        if (Cookie::get($cookie_name) !== $cookie_value)
        {
            $info = "Edit / Delete post time out.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return compact("info", "refer");
        }

        return 0;
    }

    protected function validateCookieTopic($topic)
    {

    }
}
