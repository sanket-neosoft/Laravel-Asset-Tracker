<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetImage;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AssetImport;
use App\Exports\AssetExport;

class AssetController extends Controller
{
    // shows assets table data on asset blade
    public function asset()
    {
        $assets = Asset::orderBy('created_at', 'DESC')->paginate(10);
        return view('asset', ['assets' => $assets]);
    }

    // add asset form 
    public function add_asset()
    {
        $asset_types = AssetType::all();
        return view('add_asset', ['asset_types' => $asset_types]);
    }

    // insert data in assets table and asset_images table
    public function insert_asset(Request $request)
    {
        $validator = $request->validate([
            'asset_name' => 'required',
            'asset_type' => 'required',
            'asset_images.*' => 'mimes:png,jpg',
        ]);
        if ($validator) {
            $asset = new Asset();
            $asset->asset_name = $request->asset_name;
            $uuid = substr(time() . rand(), 2, 16);
            $asset->uuid = $uuid;
            if ($request->active === "on") {
                $asset->active = true;
            } else {
                $asset->active = false;
            }
            $asset->asset_types_id = $request->asset_type;
            $asset->save();
            if ($request->hasfile('asset_images')) {
                foreach ($request->file('asset_images') as $asset_image) {
                    $image = new AssetImage();
                    $image->asset_uuid = $uuid;
                    $fn = "asset-" . time() . '-' . rand() . $asset_image->extension();
                    $asset_image->move(public_path('images'), $fn);
                    $image->image = $fn;
                    $image->save();
                }
            }
            return back()->with('status', 'Asset ' . $request->asset_name . ' added successfully.');
        }
    }

    // delete data from assets table 
    public function delete_asset($id)
    {
        $asset = Asset::find($id);
        $asset_name = $asset->asset_name;
        if ($asset->delete()) {
            return response()->json($asset_name);
        }
    }

    // get data of particular asset using id as parameter and shows edit asset form and renders update_asset blade
    public function get_asset($id)
    {
        $asset = Asset::find($id);
        if ($asset) {
            $asset_types = AssetType::all();
            return view('update_asset', ['asset' => $asset, 'asset_types' => $asset_types]);
        }
    }

    // update data of particular asset and redirect ot asset blade
    public function update_asset(Request $request)
    {
        $validator = $request->validate([
            'asset_name' => 'required',
            'asset_images.*' => 'mimes:png,jpg'
        ]);
        if ($validator) {
            $asset = Asset::find($request->id);
            $asset->asset_name = $request->asset_name;
            if ($request->asset_type) {
                $asset->asset_types_id = $request->asset_type;
            } else {
                $asset->asset_types_id = $request->type;
            }
            if ($request->active === "on") {
                $asset->active = true;
            } else {
                $asset->active = false;
            }
            if ($asset->save()) {
                if ($request->hasfile('asset_images')) {
                    foreach ($request->file('asset_images') as $asset_image) {
                        $image = new AssetImage();
                        $image->asset_uuid = $asset->uuid;
                        $fn = "asset-" . time() . '-' . rand() . $asset_image->extension();
                        $asset_image->move(public_path('images'), $fn);
                        $image->image = $fn;
                        $image->save();
                    }
                }
                return redirect(url()->previous())->with('status', 'Asset ' . $request->asset_name . ' updated successfully.');
            }
        }
    }

    // show images of particular asset using uuid as parameter 
    public function show_images($uuid)
    {
        $asset_id = Asset::where('uuid', $uuid)->first()->id;
        $images = AssetImage::where('asset_uuid', $uuid)->get();
        return view('images', ['images' => $images, 'asset_id' => $asset_id]);
    }

    //delete particular asset_image using id as parameter
    public function delete_image($id) 
    {
        if(AssetImage::find($id)->delete()) {
            return back();
        }
    }

    // assets table data download code 
    public function fileImportExport()
    {
        return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        Excel::import(new AssetImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new AssetExport, 'assets.csv');
    }
}
