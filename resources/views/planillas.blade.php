@extends('layouts.layout_panel')
<title>Gestión de Planillas | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<style>
  /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (PAGINA DE INICIO)*/
    table th {
      text-align: center; 
    }
    .td_acciones{
      text-align: center;
    }
    .container{
      background-color: #ecf0f1;
      border-radius: 6px 6px 6px 6px;
      -moz-border-radius: 6px 6px 6px 6px;
      -webkit-border-radius: 6px 6px 6px 6px;
      border: 0px solid #000000;
    }
    .bg-body-tertiary {
      --bs-bg-opacity: 1;
      background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;

    }   
</style>
<center><h1 class="display-4">GESTIÓN DE PLANILLAS</h1></center>
    <div class="container">
      <br>
       @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
      <!--BOTON DE HISTORIAL DE PAGOS-->
          <div class="col-md-12 text-right"><a title="Historial de pagos" href="{{route('pagos.index')}}" type="submit" class="btn btn-info float-start position-relative"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
        </svg></a></div>
       @else
       @endif 
      <!--FIN DE BOTON DE HISTORIAL DE PAGOS--> 
          <br><br>
        <form action="{{route('planillas.busqueda')}}" method="GET" class="d-flex" role="search">
            <label for="busqueda" hidden>Formulario de búsqueda:</label><input class="form-control me-2" type="search" id="busqueda" name="valores" placeholder="Planilla, apellidos, número de medidor o cédula" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>

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
    <!--INICIO TABLA CON DATOS-->
    <div class="table-responsive">
            <div class="mt-1 float-start text-muted"><i class="fa-regular fa-lightbulb"></i><strong> Consejo: </strong>Para ampliar los detalles de la planilla, haz clic en el número de planilla.</div>
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-md">
          <thead>
            <tr>
              <th scope="col">Planilla</th>
              <th scope="col">Medidor</th>
             <!-- <th scope="col">Cédula</th>-->
              <th scope="col">Cliente</th>
              <th scope="col">Valor actual</th>
              <!--<th scope="col">Meses en mora</th>-->
              <th scope="col">Consumo actual</th>
              <!-- <th scope="col">Consumo previo</th>-->
              <th scope="col">Fecha de Factura</th>
              <th scope="col">Fecha máxima de pago</th>
              <th scope="col">Estado del servicio</th>
              @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')<th scope="col">Acciones</th>@else @endif        
            </tr>
          </thead>
          <tbody>
            @if(count($valores_pagar)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
              @foreach ($valores_pagar as $valoresPagarItem)
            <tr>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0"  href="{{route('planillas.show', $valoresPagarItem)}}">{{$valoresPagarItem->id}}</a></td>
              <td class="td_acciones">{{$valoresPagarItem->medidor->numero_medidor}}</td>
              <td class="td_acciones"> {{$valoresPagarItem->cliente->apellido}}, {{$valoresPagarItem->cliente->nombre}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_actual}}</td>
              <!--<td class="td_acciones">{{$valoresPagarItem->meses_mora}} @if($valoresPagarItem->meses_mora == 1) mes @else meses @endif</td>-->
              <td class="td_acciones">{{$valoresPagarItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$valoresPagarItem->fecha_factura}}</td>
              <td class="td_acciones">{{$valoresPagarItem->fecha_maxima}}</td>
               @if($valoresPagarItem->estado_servicio == "activo")<td class="td_acciones"><span class="badge mt-1 text-bg-success">{{ucfirst($valoresPagarItem->estado_servicio);}}</span></td>@endif
               @if($valoresPagarItem->estado_servicio == "inactivo")<td class="td_acciones"><span class="badge mt-1 text-bg-danger">{{ucfirst($valoresPagarItem->estado_servicio);}}</span></td>@endif
          @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
              <td class="td_acciones">
              <!--INICIO DE ACCIONES-->
              <div class="btn-group">
                <!--BOTON PAGAR-->
                    <a type="button" href="{{route('planillas.ingresar', $valoresPagarItem)}}" class="btn btn-outline-success" title="Ingresar pago"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                      <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                    </svg></a>
                 <!--FIN BOTON PAGAR-->
                <!--BOTON NOTIFICAR-->
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
                        </svg>
                    </button></form>
                 <!--FIN BOTON NOTIFICAR-->                 
                  <!--INICIO DE COMPROBACION DE ESTADO DE SERVICIO-->  
                    @if($valoresPagarItem->estado_servicio == "activo") 
                     <!--BOTON CORTAR SERVICIO-->
                            <a href="{{ route('planillas.inhabilitar', $valoresPagarItem) }}" class="btn btn-outline-danger suspender" title="Suspender servicio">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
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
                            </svg>
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
                    @endif
                  <!--FIN DE COMPROBACION DE ESTADO DE SERVICIO-->  
                  @else
                  <!--EN BLANCO SI EL USUARIO SOLO TIENE EL ROL DE: "PERSONAL"-->
               @endif  
                </div>
                <!--FIN DE ACCIONES-->
              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
          <!--<div class="text-muted mt-0"><caption><strong>Consejo: </strong>Para ampliar los detalles de la planilla, haz clic en el número de planilla.</caption></div>-->
      </div>
          {{$valores_pagar->links('pagination::bootstrap-4')}}
      <!--FIN TABLA CON DATOS-->
        <!--SCRIPT DATATABLE-->
          <script src="{{url('js/main.js')}}" defer></script>
        <!--FIN DE SCRIPT DATATABLE-->
<br>
    </div>
@endsection('content')