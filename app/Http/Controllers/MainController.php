<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo '<p>index</p>';
    }

    public function about()
    {
        echo '<p>about</p>';
    }

    public function contact()
    {
        echo '<p>contact</p>';
    }
}
