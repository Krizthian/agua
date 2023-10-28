@if(isset(session()->get('sesion')['usuario']) && session()->get('sesion')['rol'] != 'administrador')
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_panel')
<title>Gestión de Usuarios | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
   <style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (USUARIOS)*/
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

<center><h1 class="display-4">GESTIÓN DE USUARIOS</h1></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="{{route('usuarios.create')}}" type="submit" class="btn btn-success float-end"><i class="fa-solid fa-circle-plus"></i> Nuevo Usuario</a></div>
        <br><br>
        <form action="{{route('usuarios.busqueda')}}" method="GET" class="d-flex" role="search">
            <label for="busqueda" hidden>Formulario de búsqueda</label><input class="form-control me-2" id="busqueda" type="search" name="valores" placeholder="Nombres, apellidos o nombre de usuario" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>        
      <!--INICIO DE MENSAJE DE RESULTADO DE EDICION-->
        @if(session('resultado_edicion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha actualizado la información del <strong>usuario</strong> correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE EDICION-->
      
      <!--INICIO DE MENSAJE DE RESULTADO DE CREACION-->
        @if(session('resultado_creacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha creado el nuevo <strong>usuario</strong> correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE CREACION-->

        <!--INICIO DE MENSAJE DE ALERTA-->
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show">
              No se puede realizar esta acción con un <strong>Administrador</strong>, asegúrate de darle un rol distinto antes de intentarlo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE ALERTA-->

        <!--INICIO DE MENSAJE DE RESULTADOS DE ACCION DE INHABILITAR/HABILITAR-->
        @if(session('resultado'))
          <div class="alert alert-success alert-dismissible fade show">
              {{session('resultado')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS DE ACCION DE INHABILITAR/HABILITAR-->

      <!--INICIO DE TABLA CON VALORES-->
      <div class="table-responsive">
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Usuario</th>
              <th scope="col">Nombres</th>
              <th scope="col">Cédula/RUC</th>
              <th scope="col">Rol</th>
              <th scope="col">Email</th>
              <th scope="col">Estado</th>
              <th scope="col" align="center">Acciones</th> 
            </tr>
          </thead>
          <tbody>  
          @if(isset($usuarios) && count($usuarios) <= 0)
            <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
          @else     
            @foreach($usuarios as $usuariosItem)
            <tr>
              <td class="td_acciones">{{$usuariosItem->usuario}}</td>
              <td class="td_acciones">{{$usuariosItem->nombre}} {{$usuariosItem->apellido}}</td>
              <td class="td_acciones">{{$usuariosItem->cedula}}</td>

              <!--COMPROBACION DE ROL DE USUARIO-->
              @if($usuariosItem->rol == "administrador")
                <td class="td_acciones"><span class="badge mt-1 text-bg-primary">{{ucfirst($usuariosItem->rol);}}</span></td>
              @elseif($usuariosItem->rol == "personal")
                <td class="td_acciones"><span class="badge mt-1 text-bg-info">{{ucfirst($usuariosItem->rol);}}</span></td>
              @elseif($usuariosItem->rol == "supervisor")
                <td class="td_acciones"><span class="badge mt-1 text-bg-secondary">{{ucfirst($usuariosItem->rol);}}</span></td>
              @endif

              <td class="td_acciones">{{$usuariosItem->email}}</td>

              <!--COMPROBACION DE ESTADO DE USUARIO-->
              @if($usuariosItem->estado_usuario == "activo")
                <td class="td_acciones"><span class="badge mt-1 text-bg-success">{{ucFirst($usuariosItem->estado_usuario)}}</span></td>
              @elseif($usuariosItem->estado_usuario == "inactivo")
                <td class="td_acciones"><span class="badge mt-1 text-bg-secondary">{{ucFirst($usuariosItem->estado_usuario)}}</span></td>
              @endif
              <!--FIN DE COMPROBACION DE ESTADO DE USUARIO-->
              
          <!--INICIO DE ACCIONES-->  
              <td class="td_acciones">    
                <div class="btn-group">
             <!--BOTON EDITAR-->
                      <a title="Editar usuario" type="button" href="{{route('usuarios.editar', $usuariosItem )}}" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a>
               <!--FIN BOTON EDITAR-->
          <!--MOSTRAMOS EL BOTON DE INHABILITAR SOLO SI EXISTE MAS DE UN USUARIO REGISTRADO-->
               @if(count($usuarios)>1)
               <!--COMPORBAMOS SI EL USUARIO ESTA ACTIVO-->
                  @if($usuariosItem->estado_usuario == "activo") 
                     <!--BOTON INHABILITAR USUARIO-->
                            <a href="{{ route('usuarios.inhabilitar', $usuariosItem) }}" class="btn btn-outline-danger inhabilitar" title="Inhabilitar usuario">
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
                                            text: '¿Estás seguro de que deseas inhabilitar el usuario seleccionado?',
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
                      <!--FIN BOTON INHABILITAR USUARIO-->
              <!--COMPROBAMOS SI EL USUARIO ESTÁ INACTIVO-->
                    @else 
                   <!--INICIO BOTON DE HABILITAR USUARIO--> 
                        <a href="{{ route('usuarios.inhabilitar', $usuariosItem) }}" class="btn btn-outline-success habilitar" title="Habilitar usuario">
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
                                        text: '¿Estás seguro de que deseas habilitar el usuario?',
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
                    <!--FIN BOTON REHABILITAR USUARIO-->    
                    @endif
                  <!--FIN DE COMPROBACION DE ESTADO DE USUARIO-->  
               @else
               <!--SINO EXISTE MAS DE UN USUARIO REGISTRADO ENTONCES NO SE MOSTRARÁ EL BOTÓN-->
             @endif 
          </div>
             <!--FIN DE ACCIONES-->
              </td>
            </tr>
              </td>
            </tr> 
                @endforeach
            @endif
          </tbody>
        </table>
      </div>
            {{$usuarios->links('pagination::bootstrap-4')}}
        <br>
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
                                  title: 'LISTADO DE USUARIOS REGISTRADOS',
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5] //Seleccionamos las columnas que se exportarán
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
                                  title: 'LISTADO DE USUARIOS REGISTRADOS',
                                  text: '<i class="fas fa-file-excel"></i>',
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5] //Seleccionamos las columnas que se exportarán
                                  },
                                  messageTop: 'Fecha de reporte: {{ now()->toDateString() }}', 
                                  titleAttr: 'Exportar a Excel'

                              },
                              {
                                  extend: 'print',
                                  className: 'btn btn-info',
                                  text: '<i class="fas fa-print"></i>',
                                  title: '<center>LISTADO DE USUARIOS REGISTRADOS</center>',
                                  messageTop: '<b>Fecha de reporte:</b> {{ now()->toDateString() }}',                                  
                                  exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5] //Seleccionamos las columnas que se exportarán
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
    </div>

@endsection('content')

@endif