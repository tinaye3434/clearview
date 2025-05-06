<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
