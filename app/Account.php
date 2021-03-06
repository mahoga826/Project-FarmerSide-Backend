<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accountno','nic','bank_name','branch','type'
    ];
	
		
	

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}