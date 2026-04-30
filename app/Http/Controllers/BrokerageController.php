<?php

namespace App\Http\Controllers;

use App\Models\Brokerage;
use Illuminate\Http\Request;

class BrokerageController extends Controller
{
    public function index()
    {
        // We fetch the first record (assuming there is only one page for Brokerage)
        $brokerage = Brokerage::first() ?? new Brokerage();
        return view('pages.brokerage', compact('brokerage'));
    }
}