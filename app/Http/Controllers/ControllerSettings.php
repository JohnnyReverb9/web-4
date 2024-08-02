<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use App\Models\Topics;
use Illuminate\Http\Request;
use App\Tcpdf;
use Nette\Utils\ImageType;

class ControllerSettings extends Controller
{
    private string $title = "Document AsocNet";

    public function index()
    {
        return view("/settings/index");
    }

    public function downloadAll()
    {

    }

    public function downloadPostsPermanents()
    {

    }

    public function downloadPosts(): void
    {
        $posts = $this->getPosts();
        $i = 1;

        $pdf = new Tcpdf();
        $pdf->AddPage();
        $pdf->SetFont('freeserif', '', 12);

        foreach ($posts as $post) {
            $pdf->SetFont('freeserif', 'B', 14);
            $pdf->Write(0, "Post #" . $i . ": " . $post->title . "\n\n");

            $pdf->SetFont('freeserif', '', 12);
            $pdf->Write(0, $post->content . "\n\n");

            if ($post->image) {
                $image_path = storage_path("app/public/" . $post->image);

                if (file_exists($image_path)) {
                    $type = str_ends_with($image_path, "jpg") ? "JPG" : "PNG";
                    $pdf->Image($image_path, 75, $pdf->GetY(), 60, 60, $type, '', 'T', true, 300, '', false, false, 1, false, false, false);
                    $pdf->Ln(70);
                }
            }

            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(10);

            $i++;
        }

        $today = now()->format("H:i:s d-m-Y");
        $title = $this->title . " POSTS " . $today . ".pdf";

        $pdf->Output($title, "D");
    }

    public function downloadPermanents(): void
    {
        $permanents = $this->getPermanents();
        $i = 1;

        $pdf = new Tcpdf();
        $pdf->AddPage();
        $pdf->SetFont('freeserif', '', 12);

        foreach ($permanents as $permanent) {
            $pdf->SetFont('freeserif', 'B', 14);
            $pdf->Write(0, "Permanent #" . $i . ": " . $permanent->title . "\n\n");

            $pdf->SetFont('freeserif', '', 12);
            $pdf->Write(0, $permanent->content . "\n\n");

            if ($permanent->image) {
                $image_path = storage_path("app/public/" . $permanent->image);

                if (file_exists($image_path)) {
                    $type = str_ends_with($image_path, "jpg") ? "JPG" : "PNG";
                    $pdf->Image($image_path, 75, $pdf->GetY(), 60, 60, $type, '', 'T', true, 300, '', false, false, 1, false, false, false);
                    $pdf->Ln(70);
                }
            }

            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(10);

            $i++;
        }

        $today = now()->format("H:i:s d-m-Y");
        $title = $this->title . " PERMANENTS " . $today . ".pdf";

        $pdf->Output($title, "D");
    }

    public function downloadTopics(): void
    {
        $topics = $this->getTopics();
        $i = 1;

        $pdf = new Tcpdf();
        $pdf->AddPage();
        $pdf->SetFont('freeserif', '', 12);

        foreach ($topics as $topic) {
            $pdf->SetFont('freeserif', 'B', 14);
            $pdf->Write(0, "Topic #" . $i . ": " . $topic->topic_title . "\n");

            $pdf->SetFont('freeserif', 'B', 12);
            $pdf->Write(0, "Total comments: " . $topic->comments . "\n\n");

            $comments = $this->getCommentsByTopic($topic->id);
            $j = 1;

            foreach ($comments as $comment) {
                $pdf->SetFont('freeserif', 'B', 12);
                $pdf->Write(0, "Comment #$j: " . "\n");

                $pdf->SetFont('freeserif', '', 12);
                $pdf->Write(0, $comment->content . "\n\n");

                $j++;
            }

            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(10);

            $i++;
        }

        $today = now()->format("H:i:s d-m-Y");
        $title = $this->title . " TOPICS " . $today . ".pdf";

        $pdf->Output($title, "D");
    }

    private function getPosts()
    {
        $posts = Post::where("is_published", 1)->get();

        return $posts;
    }

    private function getPermanents()
    {
        $permanents = Post::where("is_published", 0)->get();

        return $permanents;
    }

    private function getTopics()
    {
        $topics = Topics::all();

        return $topics;
    }

    private function getCommentsByTopic(int $id)
    {
        $comments = Comments::where("topic_id", $id)->get();

        return $comments;
    }

    private function getComments()
    {
        $comments = Comments::all();

        return $comments;
    }
}
