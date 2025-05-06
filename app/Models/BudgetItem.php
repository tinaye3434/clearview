<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function fundingRequest()
    {
        return $this->belongsTo('App\Models\FundingRequest');
    }

    public function quotations()
    {
        return $this->hasMany('App\Models\Quotation');
    }
}
