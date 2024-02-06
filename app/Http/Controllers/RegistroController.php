<?php

namespace App\Http\Controllers;

use App\Models\Necesidades;
use App\Models\Registro;
use App\Models\Resultado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retorna la vista principal de registro.
     * @param $idRegistro
     * @return Factory|View|Application
     */
    public function Index($idRegistro): Factory| View| Application
    {
        $registro = Registro::where('IdRegistro', '=', $idRegistro)->get()->first();
        return view('formacion/registro', ['registro' => $registro, 'idRegistro' => $idRegistro]);
    }

    /**
     * Guarda la informacion de registro
     * @param Request $request
     * @return JsonResponse
     */
    public function Create(Request $request): JsonResponse
    {
        try
        {
            $registro = new Registro;
            $registro = $this->Factory($registro, $request);
            $registro->save();
            return response()->json(array('success' => true, 'mensaje' => 'Registro guardado correctamente.',
                'registro' => $registro), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    /**
     * Actualiza la información de registro
     * @param Request $request
     * @param $idRegistro
     * @return JsonResponse
     */
    public function Update(Request $request, $idRegistro): JsonResponse
    {
        try
        {
            $registro = Registro::where('IdRegistro', '=', $idRegistro)->get()->first();
            $registro = $this->Factory($registro, $request);
            $registro->save();
            return response()->json(array('success' => true, 'mensaje' => 'Registro actualizado correctamente.',
                'registro' => $registro), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    /**
     * Elimina la información de registro y lo relacionado con este
     * @param $idRegistro
     * @return JsonResponse
     */
    public function Delete($idRegistro): JsonResponse
    {
        try
        {
            $informacion = Necesidades::where('IdRegistro', '=', $idRegistro)->get()->first();
            $informacion->delete();
            $resultado = Resultado::where('IdRegistro', '=', $idRegistro)->get()->first();
            $resultado->delete();
            $registro = Registro::where('IdRegistro', '=', $idRegistro)->get()->first();
            $registro->delete();
            return response()->json(array('success' => true, 'mensaje' => 'Registro eliminado correctamente.',
                'registro' => $registro), 200);
        }
        catch (Exception $exception) {
            return response()->json(array('success' => false, 'mensaje' => $exception->getMessage()), 500);
        }
    }

    /**
     * Llena la información de registro
     * @param Registro $registro
     * @param Request $request
     * @return Registro
     */
    private function Factory(Registro $registro, Request $request): Registro
    {
        $registro->IdUsuario = Auth::id();
        $registro->TipoPersona = $request->get('TipoPersona');
        $registro->NombresApellidos = $request->get('NombresApellidos');
        $registro->RazonSocial = $request->get('RazonSocial');
        $registro->RUC = $request->get('RUC');
        $registro->Universidad = $request->get('Universidad');
        $registro->ProgramaEstudios = $request->get('ProgramaEstudios');
        $registro->AnioEval = $request->get('AnioEval');
        $registro->FechaEval = $request->get('FechaEval');
        return $registro;
    }
}
