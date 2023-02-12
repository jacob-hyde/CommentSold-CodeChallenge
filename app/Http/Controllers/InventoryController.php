<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('Inventory/Index', [
            'total_inventory' => (int) Inventory::sum('quantity'),
        ]);
    }
}
