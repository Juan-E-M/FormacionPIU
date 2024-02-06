@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/navbarInterna.css') }}" rel="stylesheet">
    <nav class="navbar navbar-expand-lg bg-light" style="padding:0">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="tab">
                    <button id="buton1" class="tablinks active" onclick="mostrar(1)">Registro</button>
                    <button id="buton2" class="tablinks" onclick="mostrar(2)"
                            @if($idRegistro == 0) disabled @endif>Reconocimiento</button>
                    <button id="buton3" class="tablinks" onclick="mostrar(3)"
                            @if($idRegistro == 0) disabled @endif>Ingreso Información</button>
                    <button id="buton4" class="tablinks" onclick="mostrar(4)"
                            @if($idRegistro == 0) disabled @endif>Resultados</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-doc">
        <div class="card" style="overflow-y: scroll; height: 100%">
            <div class="card-body" id="divContenedor">
                <div id="detalle">
                    <script>
                        $.get('{{ENV('ENTORNO')}}/Registro/index/' + {{ $idRegistro }}, function(response){
                            $('#detalle').html(response);
                        });
                        document.getElementById("buton1").className = " active";
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    let lastId="buton1";

    function mostrar(numero) {
        $('#detalle').html("");
        $( "#" + lastId ).removeClass( "active" )
        switch (numero){
            case 1:
                lastId="buton1";
                $.get('/{{ENV('ENTORNO')}}Registro/index/' + {{ $idRegistro }}, function(response){
                    $('#detalle').html(response);
                });
                document.getElementById("buton1").className = " active";
                break;
            case 2:
                lastId="buton2";
                $.get('{{ENV('ENTORNO')}}/Reconocimiento/index/', function(response){
                    $('#detalle').html(response);
                });
                document.getElementById("buton2").className= " active";
                break;
            case 3:
                lastId="buton3";
                $.get('{{ENV('ENTORNO')}}/Informacion/index/' + {{ $idRegistro }}, function(response){
                    $('#detalle').html(response);
                });
                document.getElementById("buton3").className= " active";
                break;
            case 4:
                lastId="buton4";
                $.get('{{ENV('ENTORNO')}}/Resultado/index/' + {{ $idRegistro }}, function(response){
                    $('#detalle').html(response);
                });
                document.getElementById("buton4").className= " active";
                break;
        }
    }

</script>
