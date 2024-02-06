<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use App\Models\Registro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
class InformacionController extends Controller
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
        $informacion = Informacion::where('IdRegistro', '=', $idRegistro)->get()->first();
        $idUsuario = Registro::find($idRegistro)->IdUsuario;
        return view('formacion/informacion', ['informacion' => $informacion, 'idRegistro' => $idRegistro,
            'IdUsuario'=>$idUsuario] );
    }

    public function Create(Request $request): JsonResponse
    {
        try {
            $informacion = new Informacion;
            $informacion = $this->Factory($informacion, $request);
            $informacion->save();
            return response()->json(array('success' => true, 'mensaje' => 'Cantidades registradas correctamente.',
                'informacion' => $informacion), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    public function Update(Request $request, $idInformacion): JsonResponse
    {
        try {
            $informacion = Informacion::find($idInformacion);
            $informacion = $this->Factory($informacion, $request);
            $informacion->save();
            return response()->json(array('success' => true, 'mensaje' => 'Cantidades actualizadas correctamente.',
                'informacion' => $informacion), 200);
        } catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }
    private function Factory(Informacion $informacion, Request $request)
    {
        $informacion->IdRegistro = $request->get('IdRegistro');
        $informacion->CantPropInte = $request->get('CantPropInte');
        $informacion->TotalEgre = $request->get('TotalEgre');
        $informacion->TotalGrad = $request->get('TotalGrad');
        return $informacion;
    }
}
