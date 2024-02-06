@extends('layouts.app')

@section('content')
    <div class="content-grid">
        <div class="card" style="overflow-y: scroll; height: 100%">
            <div class="card-body">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-success" onclick="guardarPDF()" id="guardarPDF">
                                <i class="fa fa-file-pdf"></i> <span> Descargar</span>
                            </button>
                        </div>
                        <hr/>
                        <div class="modal-body disabledDiv" style="margin-top: 30px;" id="contenidoReporte">
                            <div class="row g-3" style="margin-bottom: 0">
                                <div class="col-md-3">
                                    <img src="{{ asset('img/ocAci.jpg') }}" width="150px" height="70px" alt="LogoReporte">
                                </div>
                                <div class="col-md-6" style="text-align: center; font-size: 20px">
                                    <b>FORMACIÓN PIU PARA DT</b>
                                </div>
                                <div class="col-md-3" style="text-align: right">
                                    Autor: Rodrigo Manrique Tejada<br>
                                    rodrigomt@entiendepiu.com<br>
                                    +51 338742242
                                </div>
                                <hr/>
                                <div class="col-md-12" style="background-color: #B4C6E7; font-size: 15px; padding: 3px">
                                    <b>REGISTRO</b>
                                </div>
                                <div class="col-md-12">
                                    <label for="TipoPersona" class="form-label">Tipo de persona</label>
                                    <input type="text" class="form-control" id="TipoPersona" name="TipoPersona"
                                           value="{{ $registro ? $registro->TipoPersona : "" }}"
                                           placeholder="Ingresa información">
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
                                    <input type="text" class="form-control" id="AnioEval" name="AnioEval"
                                           value="{{ $registro ? $registro->AnioEval : "" }}"
                                           placeholder="Ingresa información">
                                </div>
                                <div class="col-md-6">
                                    <label for="FechaEval" class="form-label">Fecha de evaluación</label>
                                    <input type="text" class="form-control" id="FechaEval" name="FechaEval"
                                           value="{{ $registro ? $registro->FechaEval : "" }}">
                                </div>
                                <div class="col-md-12" style="background-color: #B4C6E7; font-size: 15px; padding: 3px">
                                    <b>RECONOCIMIENTO</b>
                                </div>
                                <div class="col-md-12">
                                    <pre class="form-control">
    DT (f) = PIU (f) = n G + F + I + T
    G(f) = Pp+Pf
    F(f) = S
    I (f) = CI+C
    T (f)= N + O

    El Desarrollo Territorial (DT) en su esencia, está en función de la Producción Intelectual Universitaria (PIU),
    que es el suma de las actividades de:

        - Gestión (G)
        - Formación (F)
        - Investigación (I)
        - Transferencia (T)

    La G está en función la suma de Producción pasada (Pp) y de la Producción futura o proyecta (Pf).
    La F está en función de lo que requiere la Sociedad (S)
    La I está en función de la suma de capacidad instalada (CI) y el conocimiento (C)
    La T está en función de la suma de necesidad y oportunidad de los emprendedores.</pre>
                                </div>
                                <div class="col-md-12">
                                    <pre class="form-control">
    Formación PIU (F)</pre>
                                </div>
                                <div class="col-md-12">
                                    <pre class="form-control">
    F(f) = S

    S: Lo que requiere la sociedad
    Captación de RDR. Brecha entre lo esperado y lo real en cada semestre o año. Colocación de egresados y graduados

    1 pto: De 0 a 25%
    2 pto: De 26% a 50%
    3 pto: De 51% a 75%
    4 pto: De 76% a 100%</pre>
                                </div>
                                <div class="col-md-12" style="background-color: #B4C6E7; font-size: 15px; padding: 3px;
                                     margin-top: 60px !important;">
                                    <b>INGRESO INFORMACION</b>
                                </div>
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
                                <div class="col-md-6"></div>
                                <div class="col-md-12" style="background-color: #B4C6E7; font-size: 15px; padding: 3px">
                                    <b>RESULTADOS</b>
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        function guardarPDF(){
            let documento = new JsPDF('p', 'mm', [297, 220]);
            let docWidth = documento.internal.pageSize.getWidth();
            documento.html(document.querySelector('#contenidoReporte'), {
                callback: function(doc) {
                    doc.save("ReporteFormacionPIU.pdf");
                },
                autoPaging: 'text',
                margin: [10, 10, 10, 10],
                width: docWidth - 20,
                windowWidth: 1000,
            });

            //const doc = new JsPDF('p', 'mm', [297, 220]);

            /*html2canvas(document.querySelector('#contenidoReporte'), {
                width: 220,
                height: 297,
                scale: -5
            }).then((canvas) => {
                console.log()
                const img = canvas.toDataURL("image/png");
                doc.addImage(img, 'png', 20, 20, doc.internal.pageSize.getWidth() - 40,
                    doc.internal.pageSize.getHeight() - 40);
                doc.save("p&lstatement.pdf");
            })*/

        }
    </script>

@endsection
