<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QCStatus extends Model
{
    protected $table = 'qcstatus';

    protected $primaryKey  = 'qcStatusId';


    protected $fillable = [
            'qcStatus' ,

    ];


    protected $casts = [
        'qcStatusId'=> 'integer',

    ];




}
