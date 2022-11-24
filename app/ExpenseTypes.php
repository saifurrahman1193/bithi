<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseTypes extends Model
{
    protected $table = 'expensetypes';

    protected $primaryKey  = 'expenseTypeId';


    protected $fillable = [
			'expenseType' ,

    ];


    protected $casts = [
        'expenseTypeId'=> 'integer',

    ];




}
