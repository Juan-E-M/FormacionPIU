@extends('layouts.app')

@section('content')
    <div class="content-grid">
        <div class="card" style="overflow-y: scroll; height: 100%">
            <div class="card-body">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Lista de <b>Usuarios</b></h3>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalUsuarios"
                                    data-idobjetivo="0">
                                <i class="fa fa-plus-square"></i> <span>Agregar</span>
                            </button>
                        </div>
                        <hr/>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->telefono }}</td>
                                        <td>
                                            @if($usuario->id != Auth::user()->id)
                                                <button type="button" class="btn btn-danger"
                                                        onclick="EliminarUsuario(event, {{ $usuario->id }})">
                                                    <i class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></i>
                                                </button>
                                            @else
                                                Usuario actual
                                            @endif
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

    @include("usuarios.form")
@endsection

<script>
    function EliminarUsuario(e, idUsuario) {
        e.preventDefault();
        const araryData = {
            id: idUsuario,
            _token: $('#token').val(),
        };

        Swal.fire({
            title: "¿Desea eliminar el usuario?",
            showDenyButton: true,
            icon: 'question',
            confirmButtonText: 'Aceptar',
            denyButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "{{ route('eliminarUsuario') }}",
                    async: false,
                    data: araryData,
                    success: function (result) {
                        if (result.success) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Usuario eliminado correctamente.',
                                showConfirmButton: true
                            }).then((confirm) => {
                                if (confirm.isConfirmed) {
                                    window.location = "/getUsuarios";
                                }
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Ocurrio un error durante al momento de eliminar el usuario.',
                            showConfirmButton: true
                        })
                        console.log(error)
                    }
                });
            }
        });
    }
</script>
