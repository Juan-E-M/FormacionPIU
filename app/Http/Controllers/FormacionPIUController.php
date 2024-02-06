<?php

namespace App\Http\Controllers;

use App\Models\Necesidades;
use App\Models\Registro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class FormacionPIUController extends Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index(): Factory| View| Application
    {
        if(Auth::user()->esAdmin)
            $aportes = Registro::all();
        else
            $aportes = Registro::where('IdUsuario', '=', Auth::user()->id);
        return view('formacion/index', ['aportes' => $aportes] );
    }

    public function Tabs($idRegistro): Factory| View| Application
    {
        return view('formacion/tabs', ['idRegistro' => $idRegistro] );
    }
}
