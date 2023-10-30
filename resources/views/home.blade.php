@extends('layouts.layout_home')
<title>Inicio | Sistema de Consultas de Valores a Pagar del Agua</title>
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
    .image-container {
      width: 900px; 
      height: 318px;
    }
</style>

<center><h1 class="display-4">CONSULTA DE VALORES A PAGAR</h1></center>
<div class="container">
  <br><br>
          <!--INICIO DE MENSAJE DE RESULTADO DE CREACION-->
          @if(session('resultado_creacion'))
            <div class="alert alert-success alert-dismissible fade show">
                Tu <strong>reclamo</strong> se ha ingresado correctamente, nos pondremos en contacto contigo lo antes posible.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE CREACION--> 
        <!--DEVOLVEMOS MENSAJES DE ERROR-->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
          <strong>Error de validación</strong><br>
              <ul>
                @foreach ($errors->all() as $error)          
                    <li>{{ $error }}</li>
                   @endforeach   
              </ul>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>       
        </div>
    @endif
  <!--FIN DE MENSAJES DE ERROR--> 
      <form action="{{route('consulta.index')}}" method="GET" role="search">
       <div class="col-auto">
      <label for="medidor_cedula" hidden>Formulario de búsqueda:</label><center><input type="search" name="medidor_cedula" id="medidor_cedula" class="form-control" placeholder="Número de medidor, planilla o cédula" required></input></center>
      <br>
      <center><button title="Consultar" class="btn btn-primary mb-3" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
       </svg></button></center>
</div>
    </form>
    @if(!isset($resultados))
      </div>
      <center><div class="container-fluid mt-5">
          <div class="border-bottom" style="width:75%"></div>
            <a href="{{route('calculadora.index')}}">
              <img title="Calculadora de valores" alt="Calculadora de valores" class="img-fluid mt-4" src="{{url('img/banners/CalculadoraBanner.png')}}">
            </a>
       </div></center>
    @endif
    @if(isset($resultados))
         <!--INICIO TABLA CON DATOS-->
      <div class="table-responsive">
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-md">
          <thead>
            <tr>
              <th scope="col">Planilla</th>
              <th scope="col">Medidor</th>
              <th scope="col">Cédula/RUC</th>
              <th scope="col">Cliente</th>
              <th scope="col">Valor actual</th>
              <th scope="col">Meses en mora</th>
              <th scope="col">Consumo actual</th>
              <th scope="col">Fecha de Factura</th>
              <th scope="col">Fecha máxima de pago</th>
              <th scope="col">Estado del servicio</th>  
              <th scope="col">Acciones</th>  
            </tr>
          </thead>
          <tbody>
            @if(count($resultados)<=0)
            <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach($resultados as $pagosConsultaItem)
                  <!--INICIO DE MENSAJE DE ALERTA-->
                    @if(isset($pagosConsultaItem) && $pagosConsultaItem->estado_servicio == 'inactivo')
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fa-solid fa-triangle-exclamation"></i><strong> ATENCIÓN,</strong> el servicio de agua en su <strong>medidor</strong> #{{$pagosConsultaItem->medidor->numero_medidor}}, se encuentra suspendido por falta de pago, por favor, acérquese a realizar el pago lo antes posible.
                        </div>
                      @endif  
                    <!--FIN DE MENSAJE DE ALERTA-->
            <tr>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0">{{$pagosConsultaItem->id}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->medidor->numero_medidor}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->cliente->cedula}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->cliente->apellido}}, {{$pagosConsultaItem->cliente->nombre}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_actual}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->meses_mora}} @if($pagosConsultaItem->meses_mora == 1) mes @else meses @endif</td>
              <td class="td_acciones">{{$pagosConsultaItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha_factura}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha_maxima}}</td>
               @if($pagosConsultaItem->estado_servicio == "activo")<td class="td_acciones"><span class="badge mt-1 text-bg-success">{{ucfirst($pagosConsultaItem->estado_servicio);}}</span></td>@endif
               @if($pagosConsultaItem->estado_servicio == "inactivo")<td class="td_acciones"><span class="badge mt-1 text-bg-danger">{{ucfirst($pagosConsultaItem->estado_servicio);}}</span></td>@endif
              <td class="td_acciones"><a href="{{route('consulta.show', $pagosConsultaItem)}}" class="btn btn-outline-primary" title="Ver detalles de planilla" type="button"><i class="fa-solid fa-eye"></i></a></td> 
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
        <!--FIN DE LA TABLA CON DATOS-->
        <br>
        <br>
       <!--INICIO DE BANNER DE RECLAMO-->
        @isset($pagosConsultaItem)
          <center>
              <div class="container-fluid mt-4">
                <hr style="opacity:10%;">
                  <a href="{{route('reclamos.create', $pagosConsultaItem)}}" title="Ingresar un reclamo">
                  <img class="img-fluid mb-4" src="{{url('img/banners/banner_reclamo.png')}}" alt="Ingresar un reclamo"></center></a>
              </a>
             </div>
         </center>
       @endisset
     <!--FIN DE BANNER DE RECLAMO-->  
        <br>      
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
                                  title: 'LISTADO DE PLANILLAS DE CIUDADANO',
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ] //Seleccionamos las columnas que se exportarán
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
                                  extend: 'print',
                                  className: 'btn btn-info',
                                  text: '<i class="fas fa-print"></i>',
                                  title: '<center>LISTADO DE PLANILLAS DE CIUDADANO</center>',
                                  messageTop: '<b>Fecha de reporte:</b> {{ now()->toDateString() }}',                                  
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ] //Seleccionamos las columnas que se exportarán
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
    @endif
</div>

@endsection('content')