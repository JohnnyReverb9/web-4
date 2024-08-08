<?php

namespace App\Http\Controllers;

use App\classes\post\ManagementPost;
use App\Models\Post;
use App\Models\Topics;
use App\Models\UserCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\If_;

class ControllerPost extends Controller
{
    public function index(Request $request)
    {
        // $post = Post::find(1);
        // $posts = Post::all();
        // $post = Post::where("is_published", 1)->first(); // object

        $search = $request->input('search');

        if ($search)
        {
            $posts = Post::where('title', 'LIKE', "%$search%")
                ->where("is_published", 1)
                ->get();
        }
        else
        {
            $posts = Post::where("is_published", 1)->get(); // collection
        }

        $available_edit = ManagementPost::getPostsAbleToEditDelete();

        if ($request->ajax())
        {
            return response()->json([
                "html" => view("posts/search/index_content", compact("posts", "available_edit"))->render()
            ]);
        }

        return view("posts/index", compact("posts", "available_edit"));
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
            $allowed_formats = ['jpg', 'jpeg', 'png'];
            $file_extension = $request->file("image")->getClientOriginalExtension();

            if (!in_array(strtolower($file_extension), $allowed_formats))
            {
                return redirect()->back()->withInput()->withErrors(['image' => 'Only JPG, JPEG, and PNG images are allowed.']);
            }

            if ($request->file("image")->isValid())
            {
                $image_path = $request->file("image")->store("images", "public");
            }
            else
            {
                Log::error('Uploaded file is not a valid image.');
                return redirect()->back()->withInput()->withErrors(['image' => 'Uploaded file is not a valid image.']);
            }
        }

        $is_published = (int)!$request->has("is_published");

        $post = Post::create([
            "title" => $validated_data["title"],
            "content" => $validated_data["content"],
            "image" => $image_path,
            "is_published" => $is_published
        ]);

        if (!$is_published)
        {
            Topics::create([
                "post_id" => $post->id,
                "topic_title" => $validated_data["title"]
            ]);
        }

        if ($is_published)
        {
            $cookie_name = 'post_' . $post->id;
            $cookie_value = bin2hex(random_bytes(16));

            Cookie::queue($cookie_name, $cookie_value, 60 * 24); // 24 hours to edit

            UserCookie::create([
                "post_id" => $post->id,
                "cookie_name" => $cookie_name,
                "cookie_value" => $cookie_value
            ]);
        }

        if ($is_published) return redirect("/posts")->with("success", "Post created successfully.");
        else return redirect("/permanent")->with("success", "Permanent post created successfully.");
    }

    public function editPost(Request $request)
    {
        $post = Post::find($request->id);

        if (is_null($post))
        {
            $info = "Post not found.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return view("/error/error_page", compact("info", "refer"));
        }

        if ($post->is_published)
        {
            $flag = $this->validateCookie($post);

            if ($flag == 0)
            {
                return view("/posts/edit_post", compact("post", "flag"));
            }
            else
            {
                return view("/error/error_page", $flag);
            }
        }
        else
        {
            $info = "Permanent post can not be edited.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
           return view("/error/error_page", compact("info", "refer"));
        }
    }

    public function updatePost(Request $request)
    {
        $flag = $this->validateCookie($request);

        if ($flag != 0)
        {
            return view("/error/error_page", $flag);
        }

        $validated_data = $request->validate([
            "title" => "required|string|max:255",
            "content" => "nullable|string",
            "image" => "nullable|image|max:2048",
            "is_published" => "string"
        ]);

        $delete_image = (int) $request->has("delete_image");

        $post = Post::find($request->id);

        if (!$post)
        {
            return redirect("/posts")->with("error", "Post not found");
        }

        if ($request->hasFile("image"))
        {
            $allowed_formats = ['jpg', 'jpeg', 'png'];
            $file_extension = $request->file("image")->getClientOriginalExtension();

            if (!in_array(strtolower($file_extension), $allowed_formats))
            {
                return redirect()->back()->withInput()->withErrors(['image' => 'Only JPG, JPEG, and PNG images are allowed.']);
            }

            if ($request->file("image")->isValid())
            {
                $image_path = $request->file("image")->store("images", "public");
                $post->image = $image_path;
            }
            else
            {
                Log::error('Uploaded file is not a valid image.');
                return redirect()->back()->withInput()->withErrors(['image' => 'Uploaded file is not a valid image.']);
            }
        }
        elseif ($delete_image)
        {
            $post->image = null;
        }

        $post->title = $validated_data["title"];
        $post->content = $validated_data["content"];
        $post->save();

        return redirect("/posts")->with("success", "Post updated successfully.");
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->id);

        if (is_null($post))
        {
            $info = "Post not found.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return view("/error/error_page", compact("info", "refer"));
        }
        elseif ($post->is_published)
        {
            $flag = $this->validateCookie($post);

            if ($flag != 0)
            {
                return view("/error/error_page", $flag);
            }
            else
            {
                $post->delete();
                return redirect("/posts")->with("success", "Post deleted successfully.");
            }
        }
        else
        {
            $info = "Permanent post can not be deleted.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return view("/error/error_page", compact("info", "refer"));
        }
    }

    public function viewPost(Request $request)
    {
        $post_info = Post::find($request->id);

        if (is_null($post_info))
        {
            $info = "Post not found.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return view("/error/error_page", compact("info", "refer"));
        }

        $flag = 1;

        if ($post_info->is_published)
        {
            $flag = $this->validateCookie($post_info);

            if ($flag != 0)
            {
                return view("/posts/view_post", compact("post_info", "flag"));
            }
        }

        return view("/posts/view_post", compact("post_info", "flag"));
    }

    private function validateCookie($post)
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
}
