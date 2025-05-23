<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function log()
    {
        return $this->HasOne(AssetLog::class)->latestOfMany();
    }

    public function logs()
    {
        return $this->HasMany(AssetLog::class);
    }
}
