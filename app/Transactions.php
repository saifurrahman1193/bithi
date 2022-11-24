<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';

    protected $primaryKey  = 'transactionId';


    protected $fillable = [
		'transactionAmount' ,
		'transactionDate' ,
        'pmntMethodTypeId' ,
        'billId' ,
        
		'updated_at',
		'created_at'  

    ];

    protected $casts = [
        'transactionId' => 'transactionId',
        'transactionAmount' => 'double',
        'pmntMethodTypeId' => 'integer',
        'billId' => 'integer',
       
    ];



}




