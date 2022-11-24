<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillCalls extends Model
{
    protected $table = 'billcalls';

    protected $primaryKey  = 'billCallId';


    protected $fillable = [
			'billCall' ,

    ];


    protected $casts = [
        'billCallId'=> 'integer',

    ];




}
