<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    // sends staticstical data to the Home view 
    public function index()
    {
        $asset_types = AssetType::all();
        $assets = Asset::select('asset_types_id', DB::raw('SUM(active) as active'), DB::raw('COUNT(active) - SUM(active) as inactive'))->groupBy('asset_types_id')->get();

        return view('home', ['asset_types' => $asset_types, 'assets' => $assets]);
    }
}
