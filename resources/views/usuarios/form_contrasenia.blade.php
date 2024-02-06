<div class="modal fade" id="modalContrasenia" tabindex="-1" aria-labelledby="modalContraseniaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="row g-3" method="post" style="margin-bottom: 0" id="formContrasenia">
                        <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">

                        <input type="hidden" id="idUsuario" name="idUsuario" value="0">
                        <div class="col-md-12">
                            <label for="passwordActual" class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control" id="passwordActual"
                                   name="passwordActual" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-12">
                            <label for="passwordNuevo" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" id="passwordNuevo"
                                   name="passwordNuevo" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-12">
                            <label for="passwordRepetir" class="form-label">Repita contraseña</label>
                            <input type="password" class="form-control" id="passwordRepetir"
                                   name="passwordRepetir" placeholder="Ingresa información">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="GuardarContrasenia(event)"> Guardar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function GuardarContrasenia(e) {
        $("#formContrasenia").validate({
            rules: {
                passwordActual : { required: true },
                passwordNuevo: { required: true, min: 8 },
                passwordRepetir: { required: true, min: 8 }
            },
            messages: {
                passwordActual:{
                    required: "El campo Contraseña actual es obligatorio."
                },
                passwordNuevo:{
                    required: "El campo Nueva contraseña es obligatorio.",
                    min:"El campo Nueva contraseña debe tener por lo menos 8 caracteres."
                },
                passwordRepetir:{
                    required: "El campo Repita contraseña es obligatorio.",
                    min: "El campo Repita contraseña debe tener por lo menos 8 caracteres."
                }
            }
        });
        // POST
        if ($("#formContrasenia").valid()) {
            const araryData = {
                passwordActual: $('#passwordActual').val(),
                passwordNuevo: $('#passwordNuevo').val(),
                passwordRepetir: $('#passwordRepetir').val(),
                _token: $('#token').val(),
            };

            Swal.fire({
                title: "¿Desea actualizar su contraseña?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: 'Guardar',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route ('actualizarPassword') }}",
                        async: false,
                        data: araryData,
                        success: function (result) {
                            if (result.success) {
                                $('#modalUsuarios').modal('toggle');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Contraseña guardada correctamente.',
                                    showConfirmButton: true
                                });
                                window.location = "/home";
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Ocurrio un error durante al momento de guardar su nueva contraseña.',
                                showConfirmButton: true
                            })
                            console.error(error)
                        }
                    });
                }
            });
        }
    }

    function GuardarUsuario(e) {
        $("#formUsuariosEdit").validate({
            rules: {
                nombres : { required: true },
                email: { required: true },
                telefono: { required: true }
            },
            messages: {
                nombres:{
                    required: "El campo Nombres y apellidos actual es obligatorio."
                },
                email:{
                    required: "El campo E-mail es obligatorio."
                },
                telefono:{
                    required: "El campo Teléfono es obligatorio."
                }
            }
        });
        if ($("#formUsuariosEdit").valid()) {
            e.preventDefault();
            const araryData = {
                nombres: $('#nombres').val(),
                email: $('#email').val(),
                telefono: $('#telefono').val(),
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
                                $('#modalUsuarios').modal('toggle');
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
