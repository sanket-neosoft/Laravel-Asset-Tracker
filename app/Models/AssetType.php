<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class AssetType extends Model
{
    use HasFactory;
    public function asset()
    {
        return $this->hasMany(Asset::class, 'asset_types_id');
    }
}
