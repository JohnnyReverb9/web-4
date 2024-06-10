<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ControllerPost extends Controller
{
    public function index()
    {
        //$post = Post::find(1);
        //$posts = Post::all();
        //$post = Post::where("is_published", 1)->first(); // object

        $posts = Post::where("is_published", 1)->get(); // collection

//        foreach ($posts as $post)
//        {
//            dump($post->title);
//        }

        return view("posts/index", compact("posts"));
    }
}
