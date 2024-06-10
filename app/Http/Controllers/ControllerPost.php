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

    public function createPost(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|string|max:255",
            "content" => "nullable|string",
            "image" => "nullable|image|max:2048"
        ]);

        $image_path = null;

        if ($request->hasFile("image"))
        {
            $image_path = $request->file("image")->store("images", "public");
        }

        Post::create([
            "title" => $validated_data["title"],
            "content" => $validated_data["content"],
            "image" => $image_path
        ]);

        return redirect("/posts")->with("success", "Post created successfully");
    }
}
