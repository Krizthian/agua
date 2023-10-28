@extends('layouts.layout_panel')
<title>Historial de Mantenimientos | Sistema de Consultas de Valores a Pagar del Agua</title>
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
<center><h1 class="display-4">HISTORIAL DE MANTENIMIENTOS</h1></center>
    <div class="container">
      <br>
      @if(request()->routeIs('mantenimientos.busqueda'))
        <!--BOTON DE REGRESAR-->
            <div class="col-md-12 bg-light text-right"><a href="{{route('mantenimientos.index')}}" title="Regresar" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
        @elseif(request()->routeIs('mantenimientos.index')) 
        <!--BOTON DE REGRESAR-->
            <div class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" title="Regresar" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
      @endif
      <br><br>
        <form action="{{route('mantenimientos.busqueda')}}" method="GET" class="d-flex" role="search">
            <label for="busqueda" hidden>Formulario de búsqueda:></label><input class="form-control me-2" type="search" id="busqueda" name="valores" placeholder="Número de solicitud o medidor" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>
      <!--INICIO DE MENSAJE DE RESULTADOS-->
          @if(session('resultado_creacion'))
            <div class="alert alert-success alert-dismissible fade show">
                {{session('resultado_creacion')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADOS-->
  <!--INICIO DE MENSAJE DE RESULTADOS DE ACTUALIZACION-->
          @if(session('resultado_actualizacion'))
            <div class="alert alert-success alert-dismissible fade show">
                {{session('resultado_actualizacion')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
  <!--FIN DE MENSAJE DE RESULTADOS DE ACTUALIZACION-->
    <!--INICIO DE MENSAJE DE RESULTADOS DE ACTUALIZACION DE ESTADO-->
          @if(session('resultado'))
            <div class="alert alert-success alert-dismissible fade show">
                {{session('resultado')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
  <!--FIN DE MENSAJE DE RESULTADOS DE ACTUALIZACION DE ESTADO-->
        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"># Medidor</th>
              <th scope="col">Fecha de Solicitud</th>
              <th scope="col">Fecha para Mantenimiento</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Responsable Asignado</th>
              <th scope="col">Detalle</th>
              <th scope="col">Estado de Mantenimiento</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($mantenimientos)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($mantenimientos as $mantenimientosItem)
            <tr>
              <td class="td_acciones">{{$mantenimientosItem->id}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="/medidores/busqueda?valores={{$mantenimientosItem->medidor->numero_medidor}}">{{$mantenimientosItem->medidor->numero_medidor}}</a></td>
              <td class="td_acciones">{{$mantenimientosItem->fecha_solicitud}}</td>
              <td class="td_acciones">{{$mantenimientosItem->fecha_mantenimiento}}</td>
              <td class="td_acciones">{{$mantenimientosItem->medidor->ubicacion}}</td>
              <td class="td_acciones">{{$mantenimientosItem->responsable_asignado}}</td>
              <td class="td_acciones">{{$mantenimientosItem->detalle}}</td>
              @if($mantenimientosItem->estado_mantenimiento == "solicitado")<td class="td_acciones"><span class="badge mt-1 text-bg-info">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              @if($mantenimientosItem->estado_mantenimiento == "en proceso")<td class="td_acciones"><span class="badge mt-1 text-bg-primary">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              @if($mantenimientosItem->estado_mantenimiento == "completado")<td class="td_acciones"><span class="badge mt-1 text-bg-success">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              <!--INICIO DE BOTONES DE ACCIONES-->
              <td class="td_acciones">
              <div class="btn-group">
                @if($mantenimientosItem->estado_mantenimiento == "en proceso")
                <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO RESUELTO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como completado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                    <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
                  </svg></a>
                 <!--FIN ACTUALIZAR ESTADOA A MARCAR COMO RESUELTO -->
                  @elseif ($mantenimientosItem->estado_mantenimiento == "solicitado")
                 <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como en proceso"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                  </svg></a>
                 <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO -->
                  @else
                 <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como solicitado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                  </svg></a>
                 <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO -->
                 @endif
                 <!--BOTON EDITAR MANTENIMIENTO-->
                    <a type="button" href="{{route('mantenimientos.edit', $mantenimientosItem)}}" class="btn btn-outline-info" title="Editar solicitud"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                 <!--FIN EDITAR MANTENIMIENTO -->
              </div>   
              </td>
              <!--FIN DE BOTONES DE ACCIONES-->
            </tr>
              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
            </div>
        </table>
      </div>
        <!--FIN DE TABLA CON VALORES-->
          {{$mantenimientos->links('pagination::bootstrap-4')}}
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
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7] //Seleccionamos las columnas que se exportarán
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
                                  text: '<i class="fas fa-file-excel"></i>',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7] //Seleccionamos las columnas que se exportarán
                                  },
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}', 
                                  titleAttr: 'Exportar a Excel'

                              },
                              {
                                  extend: 'print',
                                  className: 'btn btn-info',
                                  text: '<i class="fas fa-print"></i>',
                                  messageTop: '<b>Fecha de reporte:</b> {{ now()->toDateString() }}',                                  
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7] //Seleccionamos las columnas que se exportarán
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
      </div>  
@endsection('content')