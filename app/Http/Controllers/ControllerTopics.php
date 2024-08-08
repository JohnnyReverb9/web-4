<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Topics;
use Illuminate\Http\Request;

class ControllerTopics extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search)
        {
            $topics = Topics::where('topic_title', 'LIKE', "%$search%")->get();
        }
        else
        {
            $topics = Topics::all();
        }

        if ($request->ajax())
        {
            return response()->json([
                "html" => view("topics/search/topics_index", compact("topics"))->render()
            ]);
        }

        return view("/topics/topics", compact("topics"));
    }

    public function viewTopic(Request $request)
    {
        $topic = Topics::where("post_id", $request->post_id)->first();

        if (is_null($topic))
        {
            $info = "Topic not found.";
            $refer = [
                "title_btn" => "Back",
                "route" => ""
            ];
            return view("/error/error_page", compact("info", "refer"));
        }

        $comments = Comments::where("topic_id", $topic->id)->get();

        return view("/topics/view_topic", compact("topic", "comments"));
    }

    public function addComment(Request $request)
    {
        $validatedData = $request->validate([
            'topic_id' => 'required|integer',
            'post_id' => 'required|integer',
            'content' => 'required|string|max:255',
            'added' => 'required|string'
        ]);

        $comment = Comments::create($validatedData);

        $topic = Topics::find($validatedData['topic_id']);
        $topic->increment('comments');

        return response()->json($comment);
    }
}
