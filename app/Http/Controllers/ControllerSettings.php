<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Tcpdf;

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

    public function downloadPosts()
    {
        $today = today()->toDateTimeString("minute");
        $posts = $this->getPosts();
        $pdf = new Tcpdf();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'courier new', 12);
        // $pdf->Write(0, 'Hello World');

        foreach ($posts as $post)
        {
            $pdf->Write(1, $post->title);
        }

        $title = $this->title . " POSTS " . $today;

        $pdf->Output($title, "I");
    }

    public function downloadPermanents()
    {

    }

    public function downloadTopics()
    {

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
}
