<?php

namespace App\Imports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\ToModel;

class AssetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Asset([
            'id' => $row[0],
            'name' => $row[1],
            'uuid' => $row[2],
            'asset_type_id' => $row[3],
            'active' => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6]
        ]);
    }
}
