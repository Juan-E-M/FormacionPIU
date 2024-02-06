<form class="row g-3 @if(Auth::user()->id != $IdUsuario) disabledDiv @endif" method="post" style="margin-bottom: 0" id="formInformacion">
    <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="IdInformacion" name="IdInformacion" value="{{  $informacion ? $informacion->IdInformacion : 0 }}">
    <div class="col-md-6">
        <label for="CantPropInte" class="form-label">Cantidad de tesis, artículos, libros, capítulos de libros,
            propiedades intelectuales</label>
        <input type="text" class="form-control" id="CantPropInte" name="CantPropInte"
               value="{{ $informacion ? $informacion->CantPropInte : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="TotalEgre" class="form-label">Total de egresados en el año de análisis</label>
        <input type="text" class="form-control" id="TotalEgre" name="TotalEgre"
               value="{{ $informacion ? $informacion->TotalEgre : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="TotalGrad" class="form-label">Total de graduados en el año de análisis</label>
        <input type="text" class="form-control" id="TotalGrad" name="TotalGrad"
               value="{{ $informacion ? $informacion->TotalGrad : "" }}"
               placeholder="Ingresa información">
    </div>
    @if(Auth::user()->id == $IdUsuario)
        <hr/>
        <div class="modal-footer" style="margin-top: 15px">
            <button type="button" id="guardarInformacion" class="btn btn-success" onclick="GuardarInformacion(event)">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>
    @endif
</form>

<script>
    function GuardarInformacion(e) {
        $("#formInformacion").validate({
            rules: {
                CantPropInte : { required: true },
                TotalEgre: { required: true },
                TotalGrad: { required: true }
            },
            messages: {
                CantPropInte:{
                    required: "El campo es obligatorio."
                },
                TotalEgre:{
                    required: "El campo es obligatorio."
                },
                TotalGrad:{
                    required: "El campo obligatorio."
                }
            }
        });
        // POST
        if ($("#formInformacion").valid()) {
            e.preventDefault();
            let idInformacion = $('#IdInformacion').val();

            let urlPost = '{{route("InformacionPIUUpdate", ':idInformacion')}}';
            urlPost = urlPost.replace(':idInformacion', idInformacion);
            if (idInformacion === '0') {
                urlPost = '{{ route('InformacionPIUCreate') }}';
            }

            const araryData = {
                IdRegistro: {{ $idRegistro }},
                CantPropInte: $('#CantPropInte').val(),
                TotalEgre: $('#TotalEgre').val(),
                TotalGrad: $('#TotalGrad').val(),
                _token: $('#token').val()
            };

            Swal.fire({
                title: "¿Desea guardar los cambios?",
                showDenyButton: true,
                icon: 'question',
                confirmButtonText: 'Guardar',
                denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: urlPost,
                        async: false,
                        data: araryData,
                        success: function (result) {
                            if (result.success) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: result.mensaje,
                                    showConfirmButton: true
                                });
                                $('#detalle').load('{{ route('InformacionPIUIndex', $idRegistro) }}');
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: error.mensaje,
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
