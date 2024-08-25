<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ControllerArchive extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Post::where("is_published", 0);

        if ($search) {
            $query->where('title', 'LIKE', "%$search%");
        }

        $archived_posts = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                "html" => view("permanent/search/index_content", compact("archived_posts"))->render(),
                "next_page" => $archived_posts->nextPageUrl()
            ]);
        }

        return view("permanent/index", compact("archived_posts"));
    }
}
