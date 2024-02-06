<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Console\Application;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller {
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Factory|View|Application
     */
    public function getUsuarios(): Factory|View|Application {
        $usuarios = User::all();
        return view('usuarios/table', ['usuarios'=>$usuarios]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function actualizarUsuario(Request $request): JsonResponse {
        try {
            $user = Auth::user();
            $user->name =  $request->nombres;
            $user->email = $request->email;
            $user->telefono =  $request->telefono;
            $user->save();
            return response()->json(array('success' => true, 'id'=>$user->name), 200);
        }
        catch (Exception $exception){
            return response()->json(array('success' => false, 'error' => $exception->getMessage()), 500);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function eliminarUsuario(Request $request): JsonResponse {
        try {
            User::whereId($request->id)->delete();
            return response()->json(array('success' => true), 200);
        }
        catch (Exception $exception){
            return response()->json(array('success' => false, 'error' => $exception->getMessage()), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function registrarUsuario(Request $request): JsonResponse {
        try {
            $user = new user();
            $user->name = $request->nombres;
            $user->email = $request->email;
            $user->password = Hash::make($request->contrasenia);
            $user->telefono = $request->telefono;
            $user->esAdmin = $request->esAdmin;
            $user->save();
            return response()->json(array('success' => true), 200);
        }
        catch (Exception $exception){
            return response()->json(array('success' => false, 'error' => $exception->getMessage()), 500);
        }
    }
}
