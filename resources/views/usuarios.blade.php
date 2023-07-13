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

<center><h1><strong>GESTIÓN DE USUARIOS</h1></strong></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="crear-usuario" type="submit" class="btn btn-success float-end">Nuevo Usuario</a></div>
        <br><br>
         <form action="{{route('usuarios.busqueda')}}" method="GET">
           <div class="col-auto">
     		 <center><input type="text" class="form-control" name="valores" placeholder="Apellidos o nombre de usuario"></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        </div>
        <!--INICIO DE TABLA CON VALORES-->

        <!--INICIO DE MENSAJE DE ALERTA-->
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show">
              No se puede eliminar un <strong>Administrador</strong>, asegúrate de darle un rol distinto antes de intentar eliminarlo.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE ALERTA-->

        <table class=" table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Usuario</th>
              <th scope="col">Nombres</th>
              <th scope="col">Cédula</th>
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
              <td class="td_acciones">{{$usuariosItem->id}}</td>
              <td class="td_acciones">{{$usuariosItem->usuario}}</td>
              <td class="td_acciones">{{$usuariosItem->nombre}} {{$usuariosItem->apellido}}</td>
              <td class="td_acciones">{{$usuariosItem->cedula}}</td>
              <td class="td_acciones">{{$usuariosItem->rol}}</td>
              <td class="td_acciones">{{$usuariosItem->email}}</td>
              <td class="td_acciones">
           <!--BOTON EDITAR-->
                <div class="btn-group">
                    <form action="" method="POST">
                      @csrf @method('UPDATE')
                    <button title="Editar usuario" type="button" href="editar.php" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></button>
                    </form></div>
             <!--FIN BOTON EDITAR-->

            <!--BOTON ELIMINAR-->
                     <div class="btn-group"><form action="{{route('usuarios.destroy', $usuariosItem )}}" method="POST">
                      @csrf @method('DELETE')
                      <button title="Eliminar usuario" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg></button>
                    </form></div>
            <!--FIN BOTON ELIMINAR-->
              </td>
            </tr>
              </td>
            </tr> 
                @endforeach
            @endif
          </tbody>
        </table>
            {{$usuarios->links('pagination::bootstrap-4')}}
        <br>
        <!--FIN DE TABLA CON VALORES-->
    </div>

@endsection('content')

@endif