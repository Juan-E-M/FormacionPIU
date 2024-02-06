<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $primaryKey = 'IdRegistro';
    protected $table = 'registro';
    protected $fillable = [
        'IdRegistro',
        'IdUsuario',
        'TipoPersona',
        'NombresApellidos',
        'RazonSocial',
        'RUC',
        'Universidad',
        'ProgramaEstudios',
        'AnioEval',
        'FechaEval',
    ];
}
