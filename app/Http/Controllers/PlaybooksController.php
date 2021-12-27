<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaybooksController extends Controller
{
    protected $viewPath = 'dashboard.playbooks.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
