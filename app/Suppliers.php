<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';

    protected $primaryKey  = 'supplierId';


    protected $fillable = [
		'supplierTitle' ,
		'yearsOfExperience' ,
		'reference' ,
		'remarks' ,
		'companyAddress', 'contactPerson','contactNumber', 'email',
		'updated_at',
		'created_at'  

    ];

    


}



