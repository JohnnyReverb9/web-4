<?php

namespace App\Http\Controllers;

use App\Models\Comments;
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
        $topic = Topics::where("post_id", $request->post_id)->first();
        $comments = Comments::where("topic_id", $topic->id)->get();

        return view("/topics/view_topic", compact("topic", "comments"));
    }

    public function addComment(Request $request)
    {
        $validatedData = $request->validate([
            'topic_id' => 'required|integer',
            'post_id' => 'required|integer',
            'content' => 'required|string|max:255',
        ]);

        $comment = Comments::create($validatedData);

        return response()->json($comment);
    }
}
