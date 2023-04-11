<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $perangkats = Perangkat::with(['perangkat_items.product' , 'latest_perangkat_history'])->where('status' , 'active')->get();
    
        return view('pages.dashboard' , compact('perangkats'));
    }
}
