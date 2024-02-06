<form class="row g-3 @if(Auth::user()->id != $IdUsuario) disabledDiv @endif" method="post" style="margin-bottom: 0" id="formResultado">
    <input type="hidden" id="token" name="token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" id="IdResultado" name="IdResultados" value="{{  $resultado ? $resultado->IdResultado : 0 }}">
    <div class="col-md-4">
        <label for="RDR" class="form-label">RDR</label>
        <input type="text" class="form-control" id="RDR" name="RDR" disabled
               value="{{ $resultado ? $resultado->RDR : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-4">
        <label for="Cant411" class="form-label">RDR real</label>
        <input type="text" class="form-control" id="Cant411" name="Cant411"
               value="{{ $resultado ? $resultado->Cant411 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-4">
        <label for="Cant412" class="form-label">RDR esperado</label>
        <input type="text" class="form-control" id="Cant412" name="Cant412"
               value="{{ $resultado ? $resultado->Cant412 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <pre class="form-control">
    1 pto: De 0 a 25%
    2 pto: De 26% a 50%
    3 pto: De 51% a 75%
    4 pto: De 76% a 100%</pre>
    </div>
    <div class="col-md-6">
        <label for="PuntosRDR" class="form-label">Puntos de RDR</label>
        <input type="text" class="form-control" id="PuntosRDR" name="PuntosRDR"
               value="{{ $resultado ? $resultado->PuntosRDR : "" }}"
               placeholder="Ingresa información">
    </div>
    <hr/>
    <div class="col-md-12">
        <label for="Egresados" class="form-label">Colocación de egresados en mercado laboral o emprendimiento</label>
        <input type="text" class="form-control" id="Egresados" name="Egresados" disabled
               value="{{ $resultado ? $resultado->Egresados : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="Cant421" class="form-label">Colocación de egresados real en mercado laboral o rendimiento</label>
        <input type="text" class="form-control" id="Cant421" name="Cant421"
               value="{{ $resultado ? $resultado->Cant421 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="Cant422" class="form-label">Colocación de egresados epserado en mercado laboral o rendimiento</label>
        <input type="text" class="form-control" id="Cant422" name="Cant422"
               value="{{ $resultado ? $resultado->Cant422 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <pre class="form-control">
    1 pto: De 0 a 25%
    2 pto: De 26% a 50%
    3 pto: De 51% a 75%
    4 pto: De 76% a 100%</pre>
    </div>
    <div class="col-md-6">
        <label for="PuntosEgresados" class="form-label">Puntos de Colocación de egresados en mercado laboral o emprendimiento</label>
        <input type="text" class="form-control" id="PuntosEgresados" name="PuntosEgresados"
               value="{{ $resultado ? $resultado->PuntosEgresados : "" }}"
               placeholder="Ingresa información">
    </div>
    <hr/>
    <div class="col-md-12">
        <label for="Egresados" class="form-label">Colocación de graduados en mercado laboral o emprendimiento</label>
        <input type="text" class="form-control" id="Egresados" name="Egresados" disabled
               value="{{ $resultado ? $resultado->Graduados : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="Cant431" class="form-label">Colocación de graduados real en mercado laboral o rendimiento</label>
        <input type="text" class="form-control" id="Cant431" name="Cant431"
               value="{{ $resultado ? $resultado->Cant431 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <label for="Cant432" class="form-label">Colocación de graduados esperada en mercado laboral o rendimiento</label>
        <input type="text" class="form-control" id="Cant432" name="Cant432"
               value="{{ $resultado ? $resultado->Cant432 : "" }}"
               placeholder="Ingresa información">
    </div>
    <div class="col-md-6">
        <pre class="form-control">
    1 pto: De 0 a 25%
    2 pto: De 26% a 50%
    3 pto: De 51% a 75%
    4 pto: De 76% a 100%</pre>
    </div>
    <div class="col-md-6">
        <label for="PuntosGraduados" class="form-label">Puntos de Colocación de graduados en mercado laboral o emprendimiento</label>
        <input type="text" class="form-control" id="PuntosGraduados" name="PuntosGraduados"
               value="{{ $resultado ? $resultado->PuntosGraduados : "" }}"
               placeholder="Ingresa información">
    </div>
    <hr/>
    <div class="col-md-3">
        <label for="ValorF" class="form-label">Valor de F</label>
        <input type="text" class="form-control" id="ValorF" name="ValorF" disabled
               value="{{ $resultado ? $resultado->ValorF : "" }}"
               placeholder="Ingresa información">
    </div>

    <div class="col-md-4">
        <pre class="form-control">
    1 pto: De 0 a 25%
    2 pto: De 26% a 50%
    3 pto: De 51% a 75%
    4 pto: De 76% a 100%</pre>
    </div>
    <div class="col-md-5">
        <pre class="form-control">
    0 puntos: Nulo aporte al DT
    De 0 a 1 puntos: Escaso aporte al DT
    De 1 a 2 puntos: Regular aporte al DT
    De 2 a 3 puntos: Buen aporte al DT
    De 3 a 4 puntos: Importante aporte al DT
    4 puntos: Máximo aporte al DT</pre>
    </div>
    @if(Auth::user()->id == $IdUsuario)
        <hr/>
        <div class="modal-footer" style="margin-top: 15px">
            <button type="button" id="guardarResultado" class="btn btn-success" onclick="GuardarResultado(event)">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>
    @endif
</form>

<script>
    function GuardarResultado(e) {
        $("#formResultado").validate({
            rules: {
                Cant411 : { required: true },
                Cant412: { required: true },
                PuntosRDR: { required: true },
                Cant421 : { required: true },
                Cant422: { required: true },
                PuntosEgresados: { required: true },
                Cant431: { required: true },
                Cant432: { required: true },
                PuntosGraduados: { required: true }
            },
            messages: {
                Cant411:{
                    required: "El campo es obligatorio."
                },
                Cant412:{
                    required: "El campo es obligatorio."
                },
                PuntosRDR:{
                    required: "El campo es obligatorio."
                },
                Cant421:{
                    required: "El campo es obligatorio."
                },
                Cant422:{
                    required: "El campo es obligatorio."
                },
                PuntosEgresados:{
                    required: "El campo es obligatorio."
                },
                Cant431:{
                    required: "El campo es obligatorio."
                },
                Cant432:{
                    required: "El campo es obligatorio."
                },
                PuntosGraduados:{
                    required: "El campo es obligatorio."
                }
            }
        });
        // POST
        if ($("#formResultado").valid()) {
            e.preventDefault();
            let idResultado = $('#IdResultado').val();

            let urlPost = '{{route("ResultadosUpdate", ':idResultado')}}';
            urlPost = urlPost.replace(':idResultado', idResultado);
            if (idResultado === '0') {
                urlPost = '{{ route('ResultadosCreate') }}';
            }

            const araryData = {
                IdRegistro: {{$idRegistro}},
                Cant411: $('#Cant411').val(),
                Cant412: $('#Cant412').val(),
                PuntosRDR: $('#PuntosRDR').val(),
                Cant421: $('#Cant421').val(),
                Cant422: $('#Cant422').val(),
                PuntosEgresados: $('#PuntosEgresados').val(),
                Cant431: $('#Cant431').val(),
                Cant432: $('#Cant432').val(),
                PuntosGraduados: $('#PuntosGraduados').val(),
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
                                $('#detalle').load('{{ route('ResultadosIndex', $idRegistro) }}');
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
            $("#DivNatural").style.visibility = 'visible';
        else
            $("#DivJuridica").style.visibility = 'visible';
    });
</script>
