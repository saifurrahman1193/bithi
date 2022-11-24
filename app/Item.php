<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    protected $table = 'item';

    protected $primaryKey  = 'itemId';


    protected $fillable = [
            'itemCode' ,
			'itemName' ,
			'categoryId',
			'description',
			'updated_at',
			'created_at'

    ];


    protected $casts = [
        'itemId'=> 'integer',
        'categoryId'=> 'integer'

    ];


    public function category()
    {
        return $this->belongsTo('App\Category', 'categoryId');
    }




}
