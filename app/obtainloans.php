<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class obtainloans extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id','loan_id','Issued_date','amount','interest_rate','expired_date','total_amount','installment','no_of_installment'
    ];
	
		
	

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}