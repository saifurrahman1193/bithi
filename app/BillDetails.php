<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{

    protected $table = 'billdetails';

    protected $primaryKey = 'billDetailId';

    protected $fillable = [

        'itemId',
        'supplierId',
        'unitPrice',
        'soldQty',
        'discountPercent',
        'totalPrice',
        'billId',
        'created_at',
        'updated_at',

    ];


    protected $casts = [
        'itemId' => 'integer',
        'supplierId' => 'integer',
        'unitPrice' => 'double',
        'soldQty' => 'double',
        'totalPrice' => 'double',
        'billId' => 'integer',

    ];

}