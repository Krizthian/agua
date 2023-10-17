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
        <table class="table-hover table-responsive table table-bordered table-striped table-sm">
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
    </div>

@endsection('content')

@endif