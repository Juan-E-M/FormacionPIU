<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $primaryKey = 'IdInformacion';
    protected $table = 'informacion';
    protected $fillable = [
        'IdInformacion',
        'IdRegistro',
        'CantPropInte',
        'TotalEgre',
        'TotalGrad'
    ];
}
