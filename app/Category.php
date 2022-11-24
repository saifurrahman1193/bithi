<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';

    protected $primaryKey  = 'categoryId';


    protected $fillable = [
		  'category' ,
		  'updated_at',
		  'created_at'

    ];




}
