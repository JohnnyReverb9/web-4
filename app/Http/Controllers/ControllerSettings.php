<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        foreach ($posts as $post)
        {
            $pdf->SetFont('freeserif', 'B', 14);
            $pdf->Write(0, "Post #" . $i . ": " . $post->title . "\n\n");

            $pdf->SetFont('freeserif', '', 12);
            $pdf->Write(0, $post->content . "\n\n");

            if ($post->image)
            {
                $image_path = storage_path("app/public/" . $post->image);

                if (file_exists($image_path))
                {
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
