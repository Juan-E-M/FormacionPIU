<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Resultado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

class ResultadoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index($idRegistro): Factory| View| Application
    {
        $resultado = Resultado::where('IdRegistro', '=', $idRegistro)->get()->first();
        $idUsuario = Registro::find($idRegistro)->IdUsuario;
        return view('formacion/resultado', ['resultado' => $resultado, 'idRegistro' => $idRegistro,
            'IdUsuario'=>$idUsuario] );
    }

    public function Create(Request $request): JsonResponse
    {
        try
        {
            $resultado = new Resultado;
            $resultado = $this->Factory($resultado, $request);
            $resultado->save();

            return response()->json(array('success' => true, 'mensaje' => 'Cantidades registradas correctamente.',
                'resultado' => $resultado), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    public function Update(Request $request, $idResultado): JsonResponse
    {
        try
        {
            $resultado = Resultado::find($idResultado);
            $resultado = $this->Factory($resultado, $request);
            $resultado->save();

            return response()->json(array('success' => true, 'mensaje' => 'Cantidades actualizadas correctamente.',
                'resultado' => $resultado), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    private function Factory(Resultado $resultado, Request $request): Resultado
    {
        $RDR = number_format($request->get('Cant411')/$request->get('Cant412'),2) + 0;
        $Egresados = number_format($request->get('Cant421')/$request->get('Cant422'),2) + 0;
        $Graduados = number_format($request->get('Cant431')/$request->get('Cant432'),2) + 0;
        $ValorF = number_format(($request->get('PuntosRDR') + $request->get('PuntosEgresados') + $request->get('PuntosGraduados'))/3,2) + 0;

        $resultado->IdRegistro = $request->get('IdRegistro');
        $resultado->Cant411 = $request->get('Cant411');
        $resultado->Cant412 = $request->get('Cant412');
        $resultado->RDR = $RDR;
        $resultado->PuntosRDR = $request->get('PuntosRDR');
        $resultado->Cant421 = $request->get('Cant421');
        $resultado->Cant422 = $request->get('Cant422');
        $resultado->Egresados = $Egresados;
        $resultado->PuntosEgresados = $request->get('PuntosEgresados');
        $resultado->Cant431 = $request->get('Cant431');
        $resultado->Cant432 = $request->get('Cant432');
        $resultado->Graduados = $Graduados;
        $resultado->PuntosGraduados = $request->get('PuntosGraduados');
        $resultado->ValorF = $ValorF;
        return $resultado;
    }
}
