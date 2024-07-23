<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tcpdf;

class ControllerSettings extends Controller
{
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
        $pdf = new Tcpdf();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Write(0, 'Hello World');
        $pdf->Output('example.pdf', 'I');
    }

    public function downloadPermanents()
    {

    }

    public function downloadTopics()
    {

    }
}
