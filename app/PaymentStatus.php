<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'paymentstatus';

    protected $primaryKey  = 'paymentStatusId';


    protected $fillable = [
            'paymentStatus' ,

    ];


    protected $casts = [
        'paymentStatusId'=> 'integer',

    ];




}
