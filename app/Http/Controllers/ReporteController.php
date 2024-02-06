<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use App\Models\Necesidades;
use App\Models\Registro;
use App\Models\Resultado;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

class ReporteController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retorna la vista principal del reporte.
     * @param $idRegistro
     * @return Factory|View|Application
     */
    public function Index($idRegistro): Factory| View| Application
    {
        $registro = Registro::find($idRegistro);
        $informacion = Informacion::where('IdRegistro', '=', $idRegistro)->get()->first();
        $resultado = Resultado::where('IdRegistro', '=', $idRegistro)->get()->first();
        return view('reporte/reporte', ['registro' => $registro, 'informacion' => $informacion,
            'resultado' => $resultado]);
    }
}
