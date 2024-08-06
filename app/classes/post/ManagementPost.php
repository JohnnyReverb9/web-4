<?php

namespace App\classes\post;

use App\classes\ManagementBase;
use App\Models\Post;
use App\Models\UserCookie;
use Illuminate\Support\Facades\Cookie;

class ManagementPost extends ManagementBase
{
    protected static $list_posts = [];
    protected static $list_permanents = [];
    protected static $post;
    protected static $permanent;
    protected static $cookie;

    protected static function findPosts(): void
    {
        self::$post = Post::where("is_published", 1);
    }

    protected static function findPermanentPosts(): void
    {
        self::$permanent = Post::where("is_published", 0);
    }

    public static function getPostsAbleToEditDelete()
    {
        self::$cookie = UserCookie::all();

        $cookie_values = [];

        foreach (self::$cookie as $cookie)
        {
            $cookie_values[$cookie->post_id] = Cookie::get($cookie->cookie_name);
        }

        return $cookie_values;
    }
}
