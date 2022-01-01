<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayController extends Controller
{
    protected $viewPath = 'dashboard.plays.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
