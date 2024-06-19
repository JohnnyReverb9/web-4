<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerTopics extends Controller
{
    public function index()
    {
        return view("/topics/topics");
    }
}
