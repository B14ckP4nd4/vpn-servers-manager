<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryVarController extends Controller
{
    protected $viewPath = 'dashboard.inventory-vars.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
