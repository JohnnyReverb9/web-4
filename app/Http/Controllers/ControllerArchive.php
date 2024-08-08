<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ControllerArchive extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search)
        {
            $archived_posts = Post::where('title', 'LIKE', "%$search%")
                ->where("is_published", 0)
                ->get();
        }
        else
        {
            $archived_posts = Post::where("is_published", 0)->get();
        }

        if ($request->ajax())
        {
            return response()->json([
                "html" => view("permanent/search/index_content", compact("archived_posts"))->render()
            ]);
        }

        return view("permanent/index", compact("archived_posts"));
    }
}
