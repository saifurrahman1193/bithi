<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $primaryKey  = 'companyId';


    protected $fillable = [
			'name' ,
			'phone',
			'address',
            'contact',
            'email',
            'logoUrl',
            'website',
            'facebook',
            'instagram',
			'updated_at',
			'created_at'

    ];


    protected $casts = [
        'companyId'=> 'integer'

    ];


}

