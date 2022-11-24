<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';

    protected $primaryKey  = 'expenseId';


    protected $fillable = [
			'expenseTypeId' , 'description', 'purpose', 'amount', 'expenseDate', 'created_at', 'updated_at'

    ];


    protected $casts = [
        'expenseId'=> 'integer',
        'expenseTypeId'=> 'integer',

    ];



}
