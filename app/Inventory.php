<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $primaryKey  = 'inventoryId';


    protected $fillable = [
            'itemId' ,
            'customerId' ,
            'supplierId' ,
            'quantity' ,
            'unitPrice',
            'sellingPrice',
            'paidAmount',
            'dueAmount',
            'unitParam' ,
            'totalPrice',
            'entryDate',
            'entryPersonId',
            'updated_at',
            'created_at'

    ];


    protected $casts = [
        'customerId' => 'integer',
        'supplierId' => 'integer',
        'inventoryId' => 'integer',
        'itemId' => 'integer',
        'quantity' => 'double',
        'unitPrice' => 'double',
        'sellingPrice' => 'double',
        'totalPrice' => 'double',

        'entryPersonId' => 'integer'
    ];



    public function supplier()
    {
        return $this->belongsTo('App\Suppliers', 'supplierId');
    }

    


}
