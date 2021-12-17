<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class AssetImage extends Model
{
    use HasFactory;
    public function asset() {
        return $this->belongsTo(Asset::class, 'asset_uuid');
    }
}
