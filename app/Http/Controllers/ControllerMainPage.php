<?php

namespace App\Http\Controllers;

use App\Models\Main;
use App\Models\Topics;
use Illuminate\Http\Request;

class ControllerMainPage extends Controller
{
    public function index()
    {
        $all_posts = Main::all()->count();
        $published_posts = Main::where("is_published", 1)->get()->count();
        $archived_posts = Main::where("is_published", 0)->get()->count();
        $topics = Topics::all()->count();

        return view("main/index", compact("all_posts", "published_posts", "archived_posts", "topics"));
    }
}
