<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    protected $table = 'deliverystatus';

    protected $primaryKey  = 'deliveryStatusId';


    protected $fillable = [
            'deliveryStatus' ,

    ];


    protected $casts = [
        'deliveryStatusId'=> 'integer',

    ];




}
