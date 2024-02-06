<div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="row g-3" style="margin-bottom: 0" id="formRegistroUsuarios">
                        <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="0">
                        <div class="col-md-6">
                            <label for="nombresApellidosRegistro" class="form-label">Nombres y apellidos</label>
                            <input type="text" class="form-control" id="nombresApellidosRegistro"
                                   name="nombresApellidosRegistro" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="emailRegistro" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="emailRegistro"
                                   name="emailRegistro" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="contraseniaRegistro" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseniaRegistro"
                                   name="contraseniaRegistro" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="telefonoRegistro" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefonoRegistro"
                                   name="telefonoRegistro" placeholder="Ingresa información">
                        </div>
                        <div class="col-md-6">
                            <label for="esAdmin" class="form-label">Administrador?</label>
                            <input type="checkbox" class="form-check" id="esAdmin"
                                   name="esAdmin">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Cerrar</button>
                <button type="button" class="btn btn-success" onclick="GuardarNuevoUsuario(event)"> Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function GuardarNuevoUsuario(e) {
        $("#formRegistroUsuarios").validate({
            rules: {
                nombresApellidosRegistro : { required: true },
                emailRegistro: { required: true },
                telefonoRegistro: { required: true },
                contraseniaRegistro: { required: true }
            },
            messages: {
                nombresApellidosRegistro:{
                    required: "El campo Nombres y apellidos actual es obligatorio."
                },
                emailRegistro:{
                    required: "El campo E-mail es obligatorio."
                },
                telefonoRegistro:{
                    required: "El campo Teléfono es obligatorio."
                },
                contraseniaRegistro:{
                    required: "El campo Contraseña es obligatorio."
                }
            }
        });
        // POST
        if ($("#formRegistroUsuarios").valid()) {
            e.preventDefault();
            let esAdmin = 0;
            if ($('#esAdmin').is(":checked"))
                esAdmin = 1;
            const araryData = {
                nombres: $('#nombresApellidosRegistro').val(),
                email: $('#emailRegistro').val(),
                contrasenia: $('#contraseniaRegistro').val(),
                telefono: $('#telefonoRegistro').val(),
                esAdmin: esAdmin,
                _token: $('#token').val(),
            };

            Swal.fire({
                title: "¿Desea registrar el nuevo usuario?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: 'Guardar',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route ('registrarUsuario') }}",
                        async: false,
                        data: araryData,
                        success: function (result) {
                            if (result.success) {
                                $('#modalUsuarios').modal('toggle');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Usuario guardado correctamente.',
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
                                title: 'Ocurrio un error durante al momento de guardar el usuario.',
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
