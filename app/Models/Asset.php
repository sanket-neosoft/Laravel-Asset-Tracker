<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetType;
use App\Models\AssetImage;

class Asset extends Model
{
    use HasFactory;
    public function asset_type() {
        return $this->belongsTo(AssetType::class, 'asset_types_id', 'id');
    }

    public function asset_image() {
        return $this->hasMany(AssetImage::class, 'asset_uuid', 'uuid');
    }
}
