<?php

namespace App\Http\Controllers;

use App\Models\Topics;
use Illuminate\Http\Request;

class ControllerTopics extends Controller
{
    public function index()
    {
        $topics = Topics::all();

        return view("/topics/topics", compact("topics"));
    }

    public function viewTopic(Request $request)
    {
        return view("/topics/view_topic");
    }

    public function openTopic(Request $request)
    {

    }
}
