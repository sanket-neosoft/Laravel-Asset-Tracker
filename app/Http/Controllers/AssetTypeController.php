<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    // shows data from asset_types table on asset_type blade
    public function asset_type()
    {
        $asset_types = AssetType::paginate(5);
        return view('asset_type', ['asset_types' => $asset_types]);
    }

    // add asset type form 
    public function add_asset_type()
    {
        return view('add_asset_type');
    }

    // insert data in asset_types table 
    public function insert_asset_type(Request $request)
    {
        $validator = $request->validate([
            'asset_type' => 'required|unique:asset_types,type_name',
            'asset_description' => 'max:500'
        ]);
        if ($validator) {
            $asset_type = new AssetType();
            $asset_type->type_name = $request->asset_type;
            $asset_type->description = $request->asset_description;
            if ($asset_type->save()) {
                return back()->with('success', 'Asset type '. $request->asset_type .' added succesfully.');
            } else {
                return back()->with('error', 'Failed to add asset type !');
            }
        }
    }

    // delete asset_type using id as parameter from asset_types table
    public function delete_asset_type($id)
    {
        $asset_type = AssetType::find($id);
        $type_name = $asset_type->type_name;
        if ($asset_type->delete()) {
            return response()->json($type_name);
        }
    }

    // get data of particular asset_type using id as parameter and renders update_asset_type blade
    public function get_asset_type($id)
    {
        $asset_type = AssetType::find($id);
        if ($asset_type) {
            return view('update_asset_type', ['asset_type' => $asset_type]);
        }
    }

    // update particular asset_type data using id as parameter and render asset_type blade
    public function update_asset_type(Request $request)
    {
        $validator = $request->validate([
            'asset_description' => 'max:500',
        ]);
        if ($validator) {
            $asset_type = AssetType::find($request->id);
            $asset_type->description = $request->asset_description;
            if ($asset_type->save()) {
                return redirect('asset-type')->with('status', 'Asset Type ' . $asset_type->type_name . ' edited successfully.');
            }
        }
    }
}
