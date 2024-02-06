@extends('layouts.app')

@section('content')
    <div class="content-grid">
        <div class="card" style="overflow-y: scroll; height: 100%">
            <div class="card-body">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Lista de Formacion <b>de PIU</b></h3>
                            <a href="{{ route('FormacionPIUTabs', ['idRegistro' => 0]) }}" class="btn btn-success">
                                <i class="fa fa-plus-square"></i> <span>Agregar</span>
                            </a>
                        </div>
                        <hr/>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">Razon Social</th>
                                    <th scope="col">RUC</th>
                                    <th scope="col">Identificación de Universidad</th>
                                    <th scope="col">Programa de estudios</th>
                                    <th scope="col">Año de evaluación</th>
                                    <th scope="col">Fecha de evaluación</th>
                                    <th scope="col">Acciones</th>
                                    <th scope="col">Reporte</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aportes as $te)
                                    <tr>
                                        <td>{{ $te->IdRegistro }}</td>
                                        <td>{{ $te->NombresApellidos }}</td>
                                        <td>{{ $te->RazonSocial }}</td>
                                        <td>{{ $te->RUC }}</td>
                                        <td>{{ $te->Universidad }}</td>
                                        <td>{{ $te->ProgramaEstudios }}</td>
                                        <td>{{ $te->AnioEval }}</td>
                                        <td>{{ $te->FechaEval }}</td>
                                        <td>
                                            @if(Auth::user()->id == $te->IdUsuario)
                                                <a href="{{ route('FormacionPIUTabs', ['idRegistro' => $te->IdRegistro]) }}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i> Editar
                                                </a>
                                                <button onclick="EliminarFormacion(event, {{ $te->IdRegistro }})" class="btn btn-danger" data-toggle="modal">
                                                    <i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> Eliminar
                                                </button>
                                            @else
                                                <a href="{{ route('FormacionPIUTabs', ['idRegistro' => $te->IdRegistro]) }}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-pencil" data-toggle="tooltip" title="Edit"></i> Ver
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('ReporteIndex', ['idRegistro' => $te->IdRegistro]) }}" class="btn btn-secondary">
                                                <i class="fa fa-th" data-toggle="tooltip" title="Reporte"></i> Reporte
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function EliminarFormacion(e, idRegistro){
        e.preventDefault();
        let urlDelete = "{{ route('RegistroDelete', ':idRegistro') }}";
        urlDelete = urlDelete.replace(':idRegistro', idRegistro);

        Swal.fire({
            title: "¿Desea eliminar el Aporte?",
            showDenyButton: true,
            icon: 'question',
            confirmButtonText: 'Aceptar',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: urlDelete,
                    data: { _token: $('#token').val() },
                    async: false,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: result.mensaje,
                                showConfirmButton: true
                            });
                            window.location.href = '{{route("FormacionPIUIndex")}}';
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: error.mensaje,
                            showConfirmButton: true
                        });
                        console.log(error)
                    }
                });
            }
        });
    }
</script>
