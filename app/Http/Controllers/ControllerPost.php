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
        else return redirect("/permanent")->with("success", "Permanent post created successfully");
    }

    public function editPost(Request $request)
    {
        $post = Post::find($request->id);

        return view("/posts/edit_post", compact("post"));
    }

    public function updatePost(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|string|max:255",
            "content" => "nullable|string",
            "image" => "nullable|image|max:2048",
            "is_published" => "string"
        ]);

        // $image_path = $validated_data["image"];
        $delete_image = (int)$request->has("delete_image");

        if ($request->hasFile("image"))
        {
            $image_path = $request->file("image")->store("images", "public");

            $ret = [
                "title" => $validated_data["title"],
                "content" => $validated_data["content"],
                "image" => $image_path
            ];
        }
        elseif ($delete_image)
        {
            $ret = [
                "title" => $validated_data["title"],
                "content" => $validated_data["content"],
                "image" => null
            ];
        }
        else
        {
            $ret = [
                "title" => $validated_data["title"],
                "content" => $validated_data["content"]
            ];
        }

        $post = Post::find($request->id);

        $post->update($ret);

        return redirect("/posts")->with("success", "Post updated successfully");
    }

    public function deletePost(Request $request)
    {
        $post = Post::where("id", $request->id)->where("is_published", 1)->first();

        if ($post->is_published)
        {
            $post->delete();
            return redirect("/posts")->with("success", "Post deleted successfully");
        }
        else
        {
            return redirect("/permanent")->with("failed", "Permanent post can not be deleted");
        }
    }

    public function viewPost(Request $request)
    {
        $post_info = Post::find($request->id);

        return view("/posts/view_post", compact("post_info"));
    }
}
