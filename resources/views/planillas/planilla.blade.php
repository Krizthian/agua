@extends('layouts.layout_panel')
<title>Detalles de Planilla  - Gestión de Planillas | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">Detalles de Planilla <strong>#{{$valoresPagarItem->id}}</strong></h1></center>
    <div class="container"> <!--INICIO DE CONTENEDOR-->  
        <br>
          <!--INICIO DE MENSAJE DE RESULTADO DE COMPROBACION DE VALOR ACTUAL-->
        @if(session('resultado_comprobacion'))
          <div class="alert alert-warning alert-dismissible fade show">
              El medidor <strong>{{session('medidor_pagado')}}</strong> no tiene valores pendientes
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE COMPROBACION DE VALOR ACTUAL-->
      <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO-->
        @if(session('resultado_ingreso'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha ingresado el pago por <strong>${{session('valor_pagado')}}</strong> al medidor <strong>{{session('medidor_pagado')}}</strong> correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->

      <!--INICIO DE MENSAJE DE RESULTADO DE CREACION DE PLANILLA-->
        @if(session('resultado_creacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha creado la nueva planilla correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE CREACION DE PLANILLA-->

        <!--INICIO DE MENSAJE DE RESULTADOS DE NOTIFICACION-->
        @if(session('resultado_notificacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha enviado una notificación de pago pendiente al cliente correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS DE NOTIFICACION-->

        <!--INICIO DE MENSAJE DE RESULTADOS DE NOTIFICACION DE VALIDACION-->
        @if(session('resultado_validacionNotificacion'))
          <div class="alert alert-warning alert-dismissible fade show">
              El medidor seleccionado no tiene valores pendientes para notificar al cliente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS DE NOTIFICACION DE VALIDACION-->

        <!--INICIO DE MENSAJE DE RESULTADOS-->
        @if(session('resultado'))
          <div class="alert alert-success alert-dismissible fade show">
              {{session('resultado')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS-->
        <!--INICIO DE BOTONES-->        
          <!--INICIO DE BOTON DE REGRESAR-->
  	        <div class="col-md-12 mb-5 bg-light text-right"><a href="{{route('planillas.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  	          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
  	        </svg></a>
          <!--FIN DE BOTON DE REGRESAR--> 
           <!--BOTON DE EXPORTAR A PDF-->
            <button title="Descargar planilla en PDF" id="exportar" class="btn btn-danger float-end" type="button" name="exportar" value="Exportar a PDF"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
              <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
          </svg></button>
        <!--FIN DE BOTON DE EXPORTAR A PDF-->
        </div>
    <!--FIN DE BOTONES-->
       <main class="w-100 m-auto">
        <div id="planilla">
          <!--LOGOTIPO DE INSTITUCION-->
            <center><img class="img-fluid mb-4" width="170" height="50" src="{{url('img/negro_logo.png')}}" alt="Ingresar un reclamo"></center>
          <!-- FIN DE LOGOTIPO DE INSTITUCION-->
        <form class="row g3">
           <div class="col-md-12 mb-2">
            <label>Cliente:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->cliente->apellido}}, {{$valoresPagarItem->cliente->nombre}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>
           <div class="col-md-12 mb-2">
            <label>Dirección:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->cliente->direccion}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>              

           <div class="col-md-6 mb-2">
            <label>Número de Planilla:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->id}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Número de Medidor:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->medidor->numero_medidor}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-12 mb-2">
            <label for="categoria_medidor">Categoría:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-house fa-sm"></i></span>
                  <input id="categoria_medidor" type="text" value="{{ucFirst($valoresPagarItem->medidor->categoria_medidor)}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Consumo actual:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->consumo->consumo_actual}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

            <div class="col-md-6 mb-2">
            <label>Consumo anterior:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->consumo->consumo_anterior}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label>Responsable de lectura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-glasses fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->consumo->responsable}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Fecha de factura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->fecha_factura}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Fecha máxima de pago:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->fecha_maxima}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Meses en mora:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$valoresPagarItem->meses_mora}}@if($valoresPagarItem->meses_mora == 1) mes @else meses @endif" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Estado de servicio:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input type="text" value="{{ucFirst($valoresPagarItem->estado_servicio)}}" name="nombre" class="form-control fw-bold @if ($valoresPagarItem->estado_servicio == 'activo') text-success border-success @elseif($valoresPagarItem->estado_servicio == 'inactivo') text-danger border-danger @endif" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label>Agua:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input type="text" value="$ {{$valorAgua = $valoresPagarItem->valor_actual - $valoresPagarItem->alcantarillado - $valoresPagarItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Alcantarillado:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-toilet fa-sm"></i></span>
                  <input type="text" value="$ {{$valoresPagarItem->alcantarillado}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Administración:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-wrench fa-sm"></i></span>
                  <input type="text" value="$ {{$valoresPagarItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label>Valor actual (Total a pagar):</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice-dollar fa-sm"></i></span>
                  <input type="text" value="$ {{$valoresPagarItem->valor_actual}}" name="nombre" class="form-control fw-bold" disabled></input>
              	</div>
              </div>
       </form></div>
       		<!--INICIO DE COMPROBACION DE ROLES-->	
       			@if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
       			   <!--INICIO DE BOTONES-->
		      			<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">      
		      	 <!--INICIO DE BOTON PAGAR-->  
                    <a type="button" href="{{route('planillas.ingresar', $valoresPagarItem)}}" class="btn btn-outline-success" title="Ingresar pago"><i class="fa-solid fa-dollar-sign fa-sm mt-2"></i> Ingresar pago</a>
               	<!--FIN DE BOTON PAGAR-->
                <!--INICIO BOTON NOTIFICAR-->
                  <!--FORMULARIO DE VALORES A NOTIFICAR-->
                  <div id="formulario_oculto_notificar" style="display: none;">
                    <form id="formulario-notificar" action="{{route('planillas.notificar')}}" method="POST">
                        @csrf
                      <input type="hidden" name="cliente_planilla_id" value="{{ $valoresPagarItem->id }}">
                      <input type="hidden" name="cliente_planilla_valorActual" value="{{ $valoresPagarItem->valor_actual }}">
                      <input type="hidden" name="cliente_planilla_fechaFactura" value="{{ $valoresPagarItem->fecha_factura }}">
                      <input type="hidden" name="cliente_planilla_fechaMaxima" value="{{ $valoresPagarItem->fecha_maxima }}">
                      <input type="hidden" name="cliente_medidor" value="{{ $valoresPagarItem->medidor->numero_medidor }}">
                      <input type="hidden" name="cliente_cedula" value="{{ $valoresPagarItem->cliente->cedula }}">
                      <input type="hidden" name="cliente_nombre" value="{{ $valoresPagarItem->cliente->nombre }}">
                      <input type="hidden" name="cliente_apellido" value="{{ $valoresPagarItem->cliente->apellido }}">
                      <input type="hidden" name="cliente_email" value="{{ $valoresPagarItem->cliente->email }}">
                    </div>
                   <!--FIN DE FORMULARIO DE VALORES A NOTIFICAR--> 
                    <button type="submit" class="btn btn-outline-primary notificar" title="Notificar al cliente">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                        </svg> Notificar al cliente
                    </button></form>
                 <!--FIN BOTON NOTIFICAR-->
                  <!--INICIO DE COMPROBACION DE ESTADO DE SERVICIO-->  
                    @if($valoresPagarItem->estado_servicio == "activo") 
                     <!--BOTON CORTAR SERVICIO-->
                            <a href="{{ route('planillas.inhabilitar', $valoresPagarItem) }}" class="btn btn-outline-danger suspender" title="Suspender servicio">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>  Suspender servicio
                            </a></div>
                            <script>
                                $(document).ready(function() {
                                    $('.suspender').click(function(event) {
                                        event.preventDefault();
                                        var url = $(this).attr('href');
                                        // Mostrar el mensaje de confirmación con SweetAlert
                                        Swal.fire({
                                            title: 'Confirmación',
                                            text: '¿Estás seguro de que deseas suspender el servicio al medidor seleccionado?',
                                            icon: 'error',
                                            showCancelButton: true,
                                            confirmButtonText: 'Sí, suspender',
                                            cancelButtonText: 'Cancelar'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Redirigir a la URL del enlace
                                                window.location.href = url;
                                            }
                                        });
                                    });
                                });
                            </script>
                      <!--FIN BOTON CORTAR SERVICIO-->
                    @else 
                   <!--INICIO BOTON DE REHABILITAR SERVICIO--> 
                        <a href="{{ route('planillas.inhabilitar', $valoresPagarItem) }}" class="btn btn-outline-info rehabilitar" title="Reactivar servicio">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg> Reactivar servicio
                        </a></div>
                        <script>
                            $(document).ready(function() {
                                $('.rehabilitar').click(function(event) {
                                    event.preventDefault();
                                    var url = $(this).attr('href');
                                    // Mostrar el mensaje de confirmación con SweetAlert
                                    Swal.fire({
                                        title: 'Confirmación',
                                        text: '¿Estás seguro de que deseas habilitar el servicio al medidor seleccionado?',
                                        icon: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: 'Sí, habilitar',
                                        cancelButtonText: 'Cancelar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Redirigir a la URL del enlace
                                            window.location.href = url;
                                        }
                                    });
                                });
                            });
                        </script>
                    <!--FIN BOTON REHABILITAR SERVICIO-->    
                    @endif <br>             
		       </div> <!--FIN DE BOTONES-->
		       @else @endif <!--FIN DE COMPROBACION DE ROLES-->
         </main>
           <!--INICIO SCRIPT PARA EXPORTAR A PDF-->
          <script>
              function generarPDF() {
                var element = document.getElementById('planilla');
                  html2pdf(element, {
                    margin: 10,
                    jsPDF: {format:'a4'},
                    filename: 'planilla_{{$valoresPagarItem->id}}_{{$valoresPagarItem->fecha_factura}}.pdf',
                    title: '',
                  });
                }
          //Con esto llamaremos al boton para generar el PDF
            var generarBoton = document.getElementById('exportar');
            generarBoton.addEventListener('click', generarPDF);
        </script>
  <!--FIN SCRIPT PARA EXPORTAR A PDF-->
        </div> <!--FIN DE CONTENEDOR-->  

@endsection('content')