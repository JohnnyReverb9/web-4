<?php

namespace App\Http\Controllers;

use App\classes\topic\ManagementTopic;
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

        $last_comments = ManagementTopic::getLastComments();

        if ($request->ajax())
        {
            return response()->json([
                "html" => view("topics/search/topics_index", compact("topics", "last_comments"))->render()
            ]);
        }

        return view("/topics/topics", compact("topics", "last_comments"));
    }

    public function viewTopic(Request $request)
    {
        $topic = Topics::where("id", $request->id)->first();

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

    public function createTopic(Request $request)
    {
        $validatedData = $request->validate([
            "topic_title" => "required|string|max:255",
        ]);

        $topic = Topics::create([
            "post_id" => 0,
            "topic_title" => $validatedData["topic_title"]
        ]);

        return redirect("/topics/view/" . $topic->id)->with("success", "Topic created successfully.");
    }

    public function createTopicForm()
    {
        return view("topics/create_topic");
    }
}
