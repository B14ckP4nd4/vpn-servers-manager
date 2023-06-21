<?php

namespace App\Http\Controllers;

class SeriesController
{
    protected $viewPath = 'dashboard.series.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }

}
