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
            <label for="busqueda" hidden>Formulario de busqueda</label><input class="form-control me-2" id="busqueda" type="search" name="valores" placeholder="Nombres, apellidos o nombre de usuario" aria-label="Buscar" required>
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
              No se puede eliminar un <strong>Administrador</strong>, asegúrate de darle un rol distinto antes de intentar eliminarlo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE ALERTA-->

        <!--INICIO DE MENSAJE DE RESULTADOS DE ELIMINACION-->
        @if(session('resultado'))
          <div class="alert alert-success alert-dismissible fade show">
              El <strong>usuario</strong> ha sido eliminado correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADOS DE ELIMINACION-->

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
              @if($usuariosItem->rol == "administrador")
              <td class="td_acciones"><span class="badge mt-1 text-bg-primary">{{ucfirst($usuariosItem->rol);}}</span></td>
              @elseif($usuariosItem->rol == "personal")
              <td class="td_acciones"><span class="badge mt-1 text-bg-info">{{ucfirst($usuariosItem->rol);}}</span></td>
              @elseif($usuariosItem->rol == "supervisor")
              <td class="td_acciones"><span class="badge mt-1 text-bg-secondary">{{ucfirst($usuariosItem->rol);}}</span></td>
              @endif
              <td class="td_acciones">{{$usuariosItem->email}}</td>
              <td class="td_acciones">
          <!--INICIO DE ACCIONES-->      
            <div class="btn-group">
             <!--BOTON EDITAR-->
                      <a title="Editar usuario" type="button" href="{{route('usuarios.editar', $usuariosItem )}}" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a>
               <!--FIN BOTON EDITAR-->
               @if(count($usuarios)>1)
               <!--MOSTRAMOS EL BOTON DE ELIMINAR SOLO SI EXISTE MAS DE UN USUARIO REGISTRADO-->
                  <!--BOTON ELIMINAR-->
                          <a title="Eliminar usuario" class="btn btn-outline-danger eliminarUsuario" href="{{route('usuarios.destroy', $usuariosItem )}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                          </svg></a></div>
                       <script>
                            $(document).ready(function() {
                                $('.eliminarUsuario').click(function(event) {
                                    event.preventDefault();
                                    var url = $(this).attr('href');
                                    // Mostrar el mensaje de confirmación con SweetAlert
                                    Swal.fire({
                                        title: 'Confirmación',
                                        text: '¿Estás seguro de que deseas eliminar el usuario seleccionado?',
                                        icon: 'error',
                                        showCancelButton: true,
                                        confirmButtonText: 'Sí, eliminar',
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
                  <!--FIN BOTON ELIMINAR-->
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