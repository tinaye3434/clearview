<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundingRequest extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function organisation()
    {
        return $this->belongsTo('App\Models\OrganisationDetail', 'organisation_id');
    }

    public function budgetItems()
    {
        return $this->hasMany('App\Models\BudgetItem');
    }

    public function budgetTotal()
    {
        return $this->hasMany('App\Models\BudgetItem')->sum('total_cost');
    }
}
