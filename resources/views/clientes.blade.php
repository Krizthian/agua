@extends('layouts.layout_panel')
<title>Gestión de Clientes | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
    <style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (CLIENTES)*/
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

<center><h1 class="display-4">GESTIÓN DE CLIENTES</h1></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="{{route('clientes.create')}}" type="submit" class="btn btn-success float-end">Nuevo Cliente</a></div>
        <br><br>

        <form action="{{route('clientes.busqueda')}}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="valores" placeholder="Nombres, apellidos o cédula" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>

        <!--INICIO DE MENSAJE DE RESULTADO DE EDICION-->
        @if(session('resultado_edicion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha actualizado la información del <strong>cliente</strong> correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE EDICION-->

        <!--INICIO DE MENSAJE DE RESULTADO DE CREACION-->
        @if(session('resultado_creacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha creado el nuevo <strong>cliente</strong> correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE CREACION-->

      <!--INICIO DE MENSAJE DE RESULTADO DE ELIMINACION-->
        @if(session('resultado'))
          <div class="alert alert-success alert-dismissible fade show">
              El <strong>cliente</strong> ha sido eliminado correctamente.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE ELIMINACION-->

        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Cédula</th>
              <th scope="col">Dirección</th>
              <th scope="col">Teléfono</th>
              <th scope="col" align="center">Acciones</th> 
            </tr>
          </thead>
          <tbody>
            @if(count($clientes)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($clientes as $clientesItem)
            <tr>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="{{route('clientes.listar', $clientesItem )}}">{{$clientesItem->nombre}} {{$clientesItem->apellido}}</a></td>
              <td class="td_acciones">{{$clientesItem->cedula}}</td>
              <td class="td_acciones">{{$clientesItem->direccion}}</td>
              <td class="td_acciones">{{$clientesItem->telefono}}</td>
              <td class="td_acciones">
             <!--INICIO DE ACCIONES-->
                <div class="btn-group">
                <!--BOTON EDITAR-->
                <div class="btn-group">
                    <a title="Editar cliente" type="button" href="{{route('clientes.editar', $clientesItem )}}" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                    </div>
                    <!--FIN BOTON EDITAR-->
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
                {{$clientes->links('pagination::bootstrap-4')}}
        <!--SCRIPT DATATABLE-->
          <script src="{{url('js/main.js')}}"></script>
        <!--FIN DE SCRIPT DATATABLE-->
      </div>
       
        <!--FIN DE TABLA CON VALORES-->
        <br>
    </div>
@endsection('content')