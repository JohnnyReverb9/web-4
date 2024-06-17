<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ControllerArchive extends Controller
{
    public function index()
    {
        $archived_posts = Post::where("is_published", 0)->get();

        return view("permanent/index", compact("archived_posts"));
    }
}
