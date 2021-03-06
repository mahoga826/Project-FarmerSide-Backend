<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class approveloans extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'approve_id';
    protected $fillable = [
        'application_id','loan_id ','approved_date','date_you_come','special_notices','approve_status'
    ];
	
		
	

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}