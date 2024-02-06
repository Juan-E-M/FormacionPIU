<div class="modal fade" id="modalUsuariosEdit" tabindex="-1" aria-labelledby="modalUsuariosEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar informacion personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="row g-3" method="post" style="margin-bottom: 0" id="formUsuariosEdit">
                        <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="0">
                        <div class="col-md-6">
                            <label for="nombresApellidosEditar" class="form-label">Nombres y apellidos</label>
                            <input type="text" class="form-control" id="nombresApellidosEditar"
                                   value="{{ Auth::user()->name }}"
                                   name="nombresApellidosEditar" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="emailEditar" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="emailEditar"
                                   value="{{ Auth::user()->email }}"
                                   name="emailEditar" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="telefonoEditar" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefonoEditar"
                                   value="{{ Auth::user()->telefono }}"
                                   name="telefonoEditar" placeholder="Ingresa información">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="GuardarUsuarioEditar(event)"> Guardar</button>
            </div>
        </div>
    </div>
</div>



<script>
    function GuardarUsuarioEditar(e) {
        $("#formUsuariosEdit").validate({
            rules: {
                nombresApellidosEditar : { required: true },
                emailEditar: { required: true },
                telefonoEditar: { required: true }
            },
            messages: {
                nombresApellidosEditar:{
                    required: "El campo Nombres y apellidos actual es obligatorio."
                },
                emailEditar:{
                    required: "El campo E-mail es obligatorio."
                },
                telefonoEditar:{
                    required: "El campo Teléfono es obligatorio."
                }
            }
        });
        // POST
        if ($("#formUsuariosEdit").valid()) {
            e.preventDefault();
            const araryData = {
                nombres: $('#nombresApellidosEditar').val(),
                email: $('#emailEditar').val(),
                telefono: $('#telefonoEditar').val(),
                _token: $('#token').val(),
            };

            Swal.fire({
                title: "¿Desea guardar su información personal?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: 'Guardar',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route ('actualizarUsuario') }}",
                        async: false,
                        data: araryData,
                        success: function (result) {
                            if (result.success) {
                                $('#modalUsuariosEditLabel').modal('toggle');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'información personal guardada correctamente.',
                                    showConfirmButton: true
                                });
                                window.location = "/home";
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Ocurrio un error durante al momento de guardar su información personal.',
                                showConfirmButton: true
                            })
                            console.error(error)
                        }
                    });
                }
            });
        }
    }
</script>
