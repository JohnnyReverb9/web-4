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
            "image" => "nullable|image|max:2048",
            "is_published" => "string"
        ]);

        $image_path = null;

        if ($request->hasFile("image"))
        {
            $image_path = $request->file("image")->store("images", "public");
        }

        $is_published = (int)!$request->has("is_published");

        Post::create([
            "title" => $validated_data["title"],
            "content" => $validated_data["content"],
            "image" => $image_path,
            "is_published" => $is_published
        ]);

        if ($is_published) return redirect("/posts")->with("success", "Post created successfully");
        else return redirect("/permanent")->with("success", "Archive post created successfully");
    }

    public function editPost()
    {

    }

    public function deletePost()
    {

    }

    public function viewPost(Request $request)
    {
        $post_info = Post::where("id", $request->id)->first();

        // dd($post_info);

        return view("/posts/post_view", compact("post_info"));
    }
}
