@extends('layouts.layout_panel')
<title>Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
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

<center><h1 class="display-4">GESTIÓN DE MEDIDORES </h1></center>
    <div class="container">
      <br>
        <!--BOTON DE HISTORIAL DE PAGOS-->
            <div class="col-md-12 text-right"><a title="Mantenimientos" href="{{route('mantenimientos.index')}}" type="submit" class="btn btn-info float-start position-relative mx-2"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE HISTORIAL DE PAGOS-->
       @if(session()->get('sesion')['rol'] == 'administrador')
     <!--BOTON DE TARIFAS INICIO-->
          <div class="col-md-12 text-right"><a href="{{route('tarifas.index')}}" type="button" title="Actualización de tarifas" class="btn btn-success float-start position-relative ">
          <svg id="svg_tarifas" xmlns="http://www.w3.org/2000/svg" height="21" width="21" viewBox="0 0 512 512" fill="currentColor"><path d="M326.7 403.7c-22.1 8-45.9 12.3-70.7 12.3s-48.7-4.4-70.7-12.3c-.3-.1-.5-.2-.8-.3c-30-11-56.8-28.7-78.6-51.4C70 314.6 48 263.9 48 208C48 93.1 141.1 0 256 0S464 93.1 464 208c0 55.9-22 106.6-57.9 144c-1 1-2 2.1-3 3.1c-21.4 21.4-47.4 38.1-76.3 48.6zM256 91.9c-11.1 0-20.1 9-20.1 20.1v6c-5.6 1.2-10.9 2.9-15.9 5.1c-15 6.8-27.9 19.4-31.1 37.7c-1.8 10.2-.8 20 3.4 29c4.2 8.8 10.7 15 17.3 19.5c11.6 7.9 26.9 12.5 38.6 16l2.2 .7c13.9 4.2 23.4 7.4 29.3 11.7c2.5 1.8 3.4 3.2 3.7 4c.3 .8 .9 2.6 .2 6.7c-.6 3.5-2.5 6.4-8 8.8c-6.1 2.6-16 3.9-28.8 1.9c-6-1-16.7-4.6-26.2-7.9l0 0 0 0 0 0c-2.2-.7-4.3-1.5-6.4-2.1c-10.5-3.5-21.8 2.2-25.3 12.7s2.2 21.8 12.7 25.3c1.2 .4 2.7 .9 4.4 1.5c7.9 2.7 20.3 6.9 29.8 9.1V304c0 11.1 9 20.1 20.1 20.1s20.1-9 20.1-20.1v-5.5c5.3-1 10.5-2.5 15.4-4.6c15.7-6.7 28.4-19.7 31.6-38.7c1.8-10.4 1-20.3-3-29.4c-3.9-9-10.2-15.6-16.9-20.5c-12.2-8.8-28.3-13.7-40.4-17.4l-.8-.2c-14.2-4.3-23.8-7.3-29.9-11.4c-2.6-1.8-3.4-3-3.6-3.5c-.2-.3-.7-1.6-.1-5c.3-1.9 1.9-5.2 8.2-8.1c6.4-2.9 16.4-4.5 28.6-2.6c4.3 .7 17.9 3.3 21.7 4.3c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-4.4-1.2-14.4-3.2-21-4.4V112c0-11.1-9-20.1-20.1-20.1zM48 352H64c19.5 25.9 44 47.7 72.2 64H64v32H256 448V416H375.8c28.2-16.3 52.8-38.1 72.2-64h16c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V400c0-26.5 21.5-48 48-48z"/></svg></a></div>
      <!--BOTON DE TARIFAS FIN-->
      @endif
        @if(session()->get('sesion')['rol'] == 'administrador')
     <!--BOTON DE CARGOS INICIO-->
          <div class="col-md-12 text-right"><a href="{{route('cargos.index')}}" type="button" title="Actualización de cargos" class="btn btn-dark float-start mx-2 position-relative"><svg class="cargos" xmlns="http://www.w3.org/2000/svg" height="21" width="21" viewBox="0 0 512 512"><style>.cargos{fill:#ffffff}</style><path d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg></a></div>
      <!--BOTON DE CARGOS FIN-->
      @endif
        @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
            <!--BOTON DE NUEVO MEDIDOR-->
             <div class="col-md-12 bg-light text-right"><a href="{{route('medidores.create')}}" type="submit" class="btn btn-success float-end"><i class="fa-solid fa-circle-plus"></i> Nuevo Medidor</a></div>
            <!--FIN BOTON DE NUEVO MEDIDOR-->
        @endif    
        <br><br>
        <form action="{{route('medidores.busqueda')}}" method="GET" class="d-flex" role="search">
            <label for="busqueda" hidden>Formulario de búsqueda></label><input class="form-control me-2" id="busqueda" type="search" name="valores" placeholder="Número de medidor" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>
        <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO-->
          @if(session('resultado_ingreso'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha ingresado el consumo correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
        <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO CON PLANILLA-->
          @if(session('resultado_ingresoPlanilla'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha ingresado el <strong>consumo</strong> correctamente y se ha creado una nueva <strong>planilla</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
        <!--INICIO DE MENSAJE DE RESULTADO DE CREACION-->
          @if(session('resultado_creacion'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha creado el medidor correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE CREACION-->
      <!--INICIO DE MENSAJE DE RESULTADO DE ACTUALIZACION-->
          @if(session('resultado_actualizacion'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha actualizado la información del medidor correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE ACTUALIZACION-->

        <!--INICIO DE MENSAJE DE RESULTADOS DE ACCION DE INHABILITAR/HABILITAR-->
        @if(session('resultado_inhabilitar'))
          <div class="alert alert-success alert-dismissible fade show">
              {{session('resultado_inhabilitar')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS DE ACCION DE INHABILITAR/HABILITAR-->

        <!--INICIO DE MENSAJE DE RESULTADOS GENERALES-->
        @if(session('resultado'))
          <div class="alert alert-warning alert-dismissible fade show">
              {{session('resultado')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS GENERALES-->

        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-md">
          <thead>
            <tr>
              <th scope="col"># Medidor</th>
              <th scope="col">Propietario</th>
              <th scope="col">Fecha de Instalación</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Categoría</th>
              <th scope="col">Consumo</th>
              <th scope="col">Responsable de lectura</th>
              <th scope="col">Fecha de lectura</th>
              <th scope="col">Estado</th>
              <th scope="col" align="center">Acciones</th> 
            </tr>
          </thead>
          <tbody>
        @if(count($consumoMedidor)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
        @else
         @foreach ($consumoMedidor as $consumoMedidorItem)   
            <tr>
              <td class="td_acciones">{{$consumoMedidorItem->numero_medidor}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="{{route('clientes.listar', $consumoMedidorItem->cliente )}}">{{$consumoMedidorItem->cliente->apellido}}, {{$consumoMedidorItem->cliente->nombre}}</a></td>
              <td class="td_acciones">{{$consumoMedidorItem->fecha_instalacion}}</td>
              <td class="td_acciones">{{$consumoMedidorItem->ubicacion}}</td>
              <td class="td_acciones">{{ucfirst($consumoMedidorItem->categoria_medidor)}}</td>
              @isset($consumoMedidorItem->consumo)
              <td class="td_acciones">{{$consumoMedidorItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$consumoMedidorItem->consumo->responsable}}</td>
              <td class="td_acciones">{{$consumoMedidorItem->consumo->fecha_lectura_actual}}</td>
              @else
               <td class="td_acciones text-muted">N/D</td>
               <td class="td_acciones text-muted">N/D</td>
               <td class="td_acciones text-muted">N/D</td>
              @endisset
              <!--COMPROBACION DE ESTADO DE MEDIDOR-->
                @if($consumoMedidorItem->estado_medidor == "activo")              
                    <td class="td_acciones"><span class="badge mt-1 text-bg-success">{{ucfirst($consumoMedidorItem->estado_medidor)}}</span></td>
                @elseif($consumoMedidorItem->estado_medidor == "inactivo")
                    <td class="td_acciones"><span class="badge mt-1 text-bg-secondary">{{ucfirst($consumoMedidorItem->estado_medidor)}}</span></td>
                @endif    
               <!--FIN DE COMPROBACION DE ESTADO DE USUARIO-->

              <!--INICIO DE BOTONES DE ACCIONES-->
              <td class="td_acciones">
              <div class="btn-group">
            <!--COMPROBAMOS ROLES-->
                @if(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'administrador')
                <!--BOTON INGRESAR CONSUMO-->
                    <a type="button" href="{{route('consumos.ingresarConsumo', $consumoMedidorItem)}}" class="btn btn-outline-primary @if($consumoMedidorItem->estado_medidor == "inactivo") disabled @endif" title=" @if($consumoMedidorItem->estado_medidor == "inactivo") disabled @else Ingresar consumo @endif"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
                    <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z"/>
                  </svg></a>
               @endif   
                 <!--FIN INGRESAR CONSUMO -->
                  <!--BOTON SOLICITAR MANTENIMIENTO-->
                    <a type="button" href="{{route('mantenimientos.create', $consumoMedidorItem)}}" class="btn btn-outline-dark" title="Solicitar mantenimiento"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                    <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                    <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                  </svg></a>
                 <!--FIN SOLICITAR MANTENIMIENTO -->
                 @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
                 <!--BOTON EDITAR MEDIDOR-->
                    <a type="button" href="{{route('medidores.edit', $consumoMedidorItem )}}" class="btn btn-outline-info" title="Editar medidor"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                 <!--FIN EDITAR MEDIDOR -->
               <!--COMPORBAMOS SI EL MEDIDOR ESTA ACTIVO-->
                  @if($consumoMedidorItem->estado_medidor == "activo") 
                     <!--BOTON INHABILITAR MEDIDOR-->
                            <a href="{{ route('medidores.inhabilitar', $consumoMedidorItem) }}" class="btn btn-outline-danger inhabilitar" title="Inhabilitar medidor">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </a></div>
                            <script>
                                $(document).ready(function() {
                                    $('.inhabilitar').click(function(event) {
                                        event.preventDefault();
                                        var url = $(this).attr('href');
                                        // Mostrar el mensaje de confirmación con SweetAlert
                                        Swal.fire({
                                            title: 'Confirmación',
                                            text: '¿Estás seguro de que deseas inhabilitar el medidor seleccionado?',
                                            icon: 'error',
                                            showCancelButton: true,
                                            confirmButtonText: 'Sí, inhabilitar',
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
                     <!--FIN BOTON INHABILITAR MEDIDOR-->                
                    <!-- COMPROBAMOS SI EL MEDIDOR ESTÁ INACTIVO-->                        
                    @else
                        <a href="{{ route('medidores.inhabilitar', $consumoMedidorItem) }}" class="btn btn-outline-success habilitar" title="Habilitar medidor">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </a></div>
                        <script>
                            $(document).ready(function() {
                                $('.habilitar').click(function(event) {
                                    event.preventDefault();
                                    var url = $(this).attr('href');
                                    // Mostrar el mensaje de confirmación con SweetAlert
                                    Swal.fire({
                                        title: 'Confirmación',
                                        text: '¿Estás seguro de que deseas habilitar el medidor?',
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
                @endif
           @endif
              </div>   
              </td>
              <!--FIN DE BOTONES DE ACCIONES-->
            </tr>
         @endforeach 
         @endif  
              </td>
            </tr> 
          </tbody>
        </table>
        {{$consumoMedidor->links('pagination::bootstrap-4')}}
      </div>        
        <!--FIN DE TABLA CON VALORES-->
<!--SCRIPT DATATABLE-->
              <script type="text/javascript">
                $(document).ready(function() {
                      $.fn.dataTable.ext.errMode = 'none';
                      $('#tabla').DataTable({
                          dom: 'Bfrtip',
                          searching: false, // Oculta la barra de búsqueda
                          info: false, // Oculta la información de paginación
                          paginate: false, // Oculta la información de paginación
                          responsive: true,
                          language: {
                              "emptyTable": "No hay datos disponibles",
                              "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                              "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                              "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                              "lengthMenu": "Mostrar _MENU_ entradas",
                          },
                             initComplete: function () {
                             $('.dt-buttons').addClass('float-end mb-3'); // Agrega la clase float-end al contenedor de botones
                            },
                          buttons: [
                              {
                                  extend: 'pdfHtml5',
                                  className: 'btn btn-danger',
                                  text: '<i class="fas fa-file-pdf"></i>',
                                  titleAttr: 'Exportar a PDF',
                                  title: 'LISTADO DE MEDIDORES REGISTRADOS',
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8] //Seleccionamos las columnas que se exportarán
                                  },
                                  customize: function ( doc ) {

                                                      doc.content.splice( 1, 0, {
                                                          margin: [ 0, 0, 0, 12 ],
                                                          alignment: 'left',
                                                          image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAAAoCAIAAACHGsgUAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAc0aVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA5LjAtYzAwMSA3OS4xNGVjYjQyLCAyMDIyLzEyLzAyLTE5OjEyOjQ0ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMSAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTA2LTA5VDE0OjQ2OjIwLTA1OjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIzLTA4LTE5VDA4OjM3OjIyLTA1OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wOC0xOVQwODozNzoyMi0wNTowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo5YThjZjI1ZC00ZDg2LTViNGItYmYzMC1lNjU3OGNkNzk2NzYiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDoxZTA5ZWI1Yi05OTE4LWE1NDctODdhOS02NDQ2NDJhN2I5ZmUiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo0ODNkZmY4Zi05ODI4LTJlNGQtOGM2Mi0zNzk4ZGExYWRhMmMiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo0ODNkZmY4Zi05ODI4LTJlNGQtOGM2Mi0zNzk4ZGExYWRhMmMiIHN0RXZ0OndoZW49IjIwMjMtMDYtMDlUMTQ6NDY6MjAtMDU6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi4xIChXaW5kb3dzKSIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6Y2ZjMmZjZDctZGQ4MC0yOTRiLThkM2ItMzEyMzVkNWIzM2MwIiBzdEV2dDp3aGVuPSIyMDIzLTA2LTA5VDE0OjQ2OjIwLTA1OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMSAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjlhOGNmMjVkLTRkODYtNWI0Yi1iZjMwLWU2NTc4Y2Q3OTY3NiIgc3RFdnQ6d2hlbj0iMjAyMy0wOC0xOVQwODozNzoyMi0wNTowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDI0LjIgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8cGhvdG9zaG9wOkRvY3VtZW50QW5jZXN0b3JzPiA8cmRmOkJhZz4gPHJkZjpsaT5hZG9iZTpkb2NpZDpwaG90b3Nob3A6MjVhODAyZTUtMWUwNi0y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'
                                                      } );
                                                  }
                                                  
                              },
                                                            {
                                  extend: 'excelHtml5',
                                  className: 'btn btn-success',
                                  title: 'LISTADO DE MEDIDORES REGISTRADOS',
                                  text: '<i class="fas fa-file-excel"></i>',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8] //Seleccionamos las columnas que se exportarán
                                  },
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}', 
                                  titleAttr: 'Exportar a Excel'

                              },
                              {
                                  extend: 'print',
                                  className: 'btn btn-info',
                                  text: '<i class="fas fa-print"></i>',
                                  title: '<center>LISTADO DE MEDIDORES REGISTRADOS</center>',
                                  messageTop: '<b>Fecha de reporte:</b> {{ now()->toDateString() }}',                                  
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8] //Seleccionamos las columnas que se exportarán
                                  },
                                  titleAttr: 'Imprimir',
                                  //Inicio marca de agua
                                    customize: function ( win ) {
                                        $(win.document.body)
                                            .css( 'font-size', '10pt' )
                                            .prepend(
                                                '<img src="https://i.imgur.com/mNg8QqN.png" style="display:block; margin-right:auto; margin-left:0;" />'
                                            );
                                        $(win.document.body).find( 'table' )
                                            .addClass( 'compact' )
                                            .css( 'font-size', 'inherit' );
                                    } //Fin marca de agua
                                }, 
                                                           
                          ]

                      });
});
              </script>
        <!--FIN DE SCRIPT DATATABLE-->
        <br><br>
    </div>

@endsection('content')