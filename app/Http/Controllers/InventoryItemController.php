<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    protected $viewPath = 'dashboard.inventory-items.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }
}
