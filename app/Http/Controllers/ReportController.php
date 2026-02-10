<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OutgoingItem;
use App\Models\IncomingItem;

class ReportController extends Controller
{
    public function incoming()
{
    $items = IncomingItem::with('product')->latest()->get();

    return view('reports.incoming', compact('items'));
}

public function outgoing()
{
    $items = OutgoingItem::with('product')->latest()->get();
    
    return view('reports.outgoing', compact('items'));
}

}


