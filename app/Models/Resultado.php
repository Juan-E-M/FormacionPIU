<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $primaryKey = 'IdResultado';
    protected $table = 'resultado';
    protected $fillable = [
        'IdResultados',
        'IdRegistro',
        'ValorN',
        'ValorO',
        'ValorT'
    ];
}
