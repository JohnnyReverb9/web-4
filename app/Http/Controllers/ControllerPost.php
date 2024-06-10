<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ControllerPost extends Controller
{
    public function index()
    {
        // $post = Post::find(1);
        // $posts = Post::all();
        // $post = Post::where("is_published", 1)->first(); // object

        $posts = Post::where("is_published", 1)->get(); // collection

       // foreach ($posts as $post)
       // {
       //     dump($post->title);
       // }

        return view("posts/index", compact("posts"));
    }

    public function formCreatePost()
    {
        return view("posts/create_post");
    }

    public function createPost()
    {
        $posts_array = [
            [
                "title" => "i wanna dog",
                "content" => "such a good dog i saw today",
                "image" => "",
                "likes" => "2",
                "is_published" => "1"
            ],
            [
                "title" => "such a lonely day",
                "content" => "come as you are",
                "image" => "",
                "likes" => "23",
                "is_published" => "1"
            ]
        ];

        Post::create([

        ]);
    }
}
