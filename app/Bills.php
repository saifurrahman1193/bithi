<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{

    protected $table = 'bills';

    protected $primaryKey = 'billId';

    protected $fillable = [

        'invoiceNo',
        'customerId',
        'invoiceDate',
        'deliveryMan',
        'totalAmount',
        'discountAmount',
        'deliveryCharge',
        'totalReceivableAmount',
        'specialInstruction',
        'qcStatusId',
        'callId',
        'deliveryStatusId',
        'pmntStatusId',
        'entryPersonId',
        'pmntMethodTypeId',
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'billId' => 'integer',
        'entryPersonId' => 'integer',
        'itemId' => 'integer',
        'unitPrice' => 'double',
        'soldQty' => 'double',
        'totalAmount' => 'double',
        'discountAmount' => 'double',
        'deliveryCharge' => 'double',
        'totalReceivableAmount' => 'double',
        'qcStatusId' => 'integer',
        'callId' => 'integer',
        'deliveryStatusId' => 'integer',
        'pmntStatusId' => 'integer',
        'pmntMethodTypeId' => 'integer',

    ];

    

}