<form class="row g-3 @if($registro != null and Auth::id() != $registro->IdUsuario) disabledDiv @endif"
      method="post" style="margin-bottom: 0" id="formRegistro">
    <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="IdRegistro" name="IdRegistro" value="{{  $registro ? $registro->IdRegistro : 0 }}">
    <div class="col-md-12">
        <label for="TipoPersona" class="form-label">Tipo de persona</label>
        <select class="form-select" id="TipoPersona" name="TipoPersona">
            <option value="Natural"
                    @if($registro != null and $registro->TipoPersona == 'Natural')
                        selected @else selected @endif>Natural</option>
            <option value="Jurídica"
                    @if($registro != null and $registro->TipoPersona == 'Jurídica')
                        selected @endif>Jurídica</option>
        </select>
    </div>
    <div id="DivNatural">
        <div class="col-md-6">
            <label for="NombresApellidos" class="form-label">Nombres y Apellidos</label>
            <input type="text" class="form-control" id="NombresApellidos" name="NombresApellidos"
                   value="{{ $registro ? $registro->NombresApellidos : "" }}"
                   placeholder="Ingresa información">
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div id="DivJuridica" style="display: none">
        <div class="col-md-6">
            <label for="RazonSocial" class="form-label">Razon Social</label>
            <input type="text" class="form-control" id="RazonSocial" name="RazonSocial"
                   value="{{ $registro ? $registro->RazonSocial : "" }}"
                   placeholder="Ingresa información">
        </div>
        <div class="col-md-6">
            <label for="RUC" class="form-label">RUC</label>
            <input type="text" class="form-control" id="RUC" name="RUC"
                   value="{{ $registro ? $registro->RUC : "" }}"
                   placeholder="Ingresa información">
        </div>
    </div>
    <div class="col-md-6">
        <label for="Universidad" class="form-label">Identificación de Universidad</label>
        <input type="text" class="form-control" id="Universidad" name="Universidad"
               value="{{ $registro ? $registro->Universidad : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="ProgramaEstudios" class="form-label">Programa de estudios</label>
        <input type="text" class="form-control" id="ProgramaEstudios" name="ProgramaEstudios"
               value="{{ $registro ? $registro->ProgramaEstudios : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="AnioEval" class="form-label">Año de evaluación</label>
        <select class="form-select" id="AnioEval" name="AnioEval">
            <?php
            for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
            <option value="<?=$year;?>" @if($registro != null and $registro->AnioEval == $year) selected @endif><?=$year;?></option>
            <?php endfor;
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="FechaEval" class="form-label">Fecha de evaluación</label>
        <input type="date" class="form-control" id="FechaEval" name="FechaEval"
               value="{{ $registro ? $registro->FechaEval : "" }}">
    </div>
    @if(($registro != null and Auth::id() == $registro->IdUsuario) or $registro == null)
        <hr/>
        <div class="modal-footer" style="margin-top: 15px">
            <button type="button" id="guardarRegistro" class="btn btn-success" onclick="GuardarRegistro(event)">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>
    @endif
</form>

<script>
    function GuardarRegistro(e) {
        $("#formRegistro").validate({
            rules: {
                Universidad : { required: true },
                ProgramaEstudios: { required: true },
                AnioEval: { required: true },
                FechaEval: { required: true }
            },
            messages: {
                Universidad:{
                    required: "El campo Identificación de Universidad es obligatorio."
                },
                ProgramaEstudios:{
                    required: "El campo Programa de estudios es obligatorio."
                },
                AnioEval:{
                    required: "El campo Año de evaluación es obligatorio."
                },
                FechaEval:{
                    required: "El campo Fecha de evaluación es obligatorio."
                }
            }
        });
        // POST
        if ($("#formRegistro").valid()) {
            e.preventDefault();
            let idRegistro = $('#IdRegistro').val();

            let urlPost = '{{ route('RegistroUpdate', ':idRegistro') }}';
            urlPost = urlPost.replace(':idRegistro', idRegistro);
            if (idRegistro === '0') {
                urlPost = '{{ route('RegistroCreate') }}';
            }
            const araryData = {
                IdRegistro: idRegistro,
                NombresApellidos: $('#NombresApellidos').val(),
                RazonSocial: $('#RazonSocial').val(),
                RUC: $('#RUC').val(),
                Universidad: $('#Universidad').val(),
                ProgramaEstudios: $('#ProgramaEstudios').val(),
                AnioEval: $('#AnioEval').val(),
                FechaEval: $('#FechaEval').val(),
                _token: $('#token').val(),
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
                                let url = '{{route("FormacionPIUTabs", ':idRegistro')}}';
                                url = url.replace(':idRegistro', result.registro.IdRegistro);
                                window.location.href = url;
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

    $('#TipoPersona').change(function() {
        let TipoPersona = $( "#TipoPersona option:selected" ).text();
        if (TipoPersona === 'Natural')
        {
            $("#DivNatural").css("display", "block");
            $("#DivJuridica").css("display", "none");
        }
        else
        {
            $("#DivNatural").css("display", "none");
            $("#DivJuridica").css("display", "block");
        }
    });

    $(document).ready(function() {
        let TipoPersona = $("#TipoPersona").val();
        if (TipoPersona === 'Natural')
        {
            $("#DivNatural").css("display", "block");
        }
        else
        {
            $("#DivNatural").css("display", "none");
            $("#DivJuridica").css("display", "block");
        }
    });
</script>
