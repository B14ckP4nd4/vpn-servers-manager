<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayBooksController extends Controller
{
    protected $viewPath = 'dashboard.playbooks.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
