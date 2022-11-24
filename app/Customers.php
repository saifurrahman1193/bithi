<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    protected $primaryKey  = 'customerId';


    protected $fillable = [
			'name' ,
			'phone',
			'address',
            'districtId',
            'area',
			'updated_at',
			'created_at'

    ];



    protected $casts = [
        'customerId'=> 'integer',
        'districtId'=> 'integer'

    ];


}
