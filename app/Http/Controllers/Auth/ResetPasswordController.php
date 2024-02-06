<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function actualizarPassword(Request $request): JsonResponse {
        try {
            if (!(Hash::check($request['passwordActual'], Auth::user()->password)))
                return response()->json(array('success' => false, 'validacion' => 'La contraseña ingresada no coincide con la contraseña actual.'), 200);
            if(strcmp($request['passwordActual'], $request['passwordNuevo']) == 0)
                return response()->json(array('success' => false, 'validacion' => 'La contraseña actual es igual que la nueva contraseña.'), 200);
            if(strcmp($request['passwordNuevo'], $request['passwordRepetir']) == 0)
                return response()->json(array('success' => false, 'validacion' => 'Las contraseñas nuevas no coinciden.'), 200);

            $validatedData = $request->validate([
                'passwordActual' => 'required',
                'passwordNuevo' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::user();
            $user->password = Hash::make($request['passwordActual']);
            $user->save();

            return response()->json(array('success' => true), 200);
        }
        catch (Exception $exception){
            return response()->json(array('success' => false, 'error' => $exception->getMessage()), 500);
        }
    }
}
