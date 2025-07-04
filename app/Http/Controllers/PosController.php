<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PosController extends Controller
{
    /**
     * Display the POS page.
     */
    public function index(): View
    {
        return view('pos.index');
    }
}
