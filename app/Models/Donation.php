<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function creator()
    {
        return $this->belongsTo(OrganisationDetail::class, 'creator_organisation_id');
    }

    public function donor()
    {
        return $this->belongsTo(OrganisationDetail::class, 'donor_organisation_id');
    }

    public function request()
    {
        return $this->belongsTo(FundingRequest::class, 'funding_request_id');
    }

}
