<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PmntMethodType extends Model
{
    protected $table = 'pmntmethodtype';

    protected $primaryKey  = 'pmntMethodTypeId';


    protected $fillable = [
			'pmntMethodType' ,

    ];


    protected $casts = [
        'pmntMethodTypeId'=> 'integer',

    ];




}
