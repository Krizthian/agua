@extends('layouts.layout_panel')

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

<center><h1><strong>GESTIÓN DE MEDIDORES</h1></strong></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="crear-medidor" type="submit" class="btn btn-success float-end">Nuevo Medidor</a></div>
        <br><br>
         <form>
           <div class="col-auto">
            <center><input type="text" class="form-control" placeholder="Nombres, número de medidor o cédula"></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        </div>
        <!--INICIO DE TABLA CON VALORES-->
        <table class=" table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Medidor Asociado</th>
              <th scope="col">Propietario</th>
              <th scope="col">Cédula</th>
              <th scope="col">Dirección</th>
              <th scope="col">Télefono</th>
              <th scope="col">Estado del Servicio</th>
              <center><th scope="col">Acciones</th></center>
           
            </tr>
          </thead>
          <tbody>
            @if($medidores)
                @foreach ($medidores as $medidoresItem)
            <tr>
              <td class="td_acciones">{{$medidoresItem->numero_medidor}}</td>
              <td class="td_acciones">{{$medidoresItem->nombre}} {{$medidoresItem->apellido}}</td>
              <td class="td_acciones">{{$medidoresItem->cedula}}</td>
              <td class="td_acciones">{{$medidoresItem->direccion}}</td>
              <td class="td_acciones">{{$medidoresItem->telefono}}</td>
              <td class="td_acciones">{{$medidoresItem->estado_servicio}}</td>
              <td class="td_acciones">
                <!--BOTON EDITAR-->
                    <a type="button" href="editar.php" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                    <!--FIN BOTON EDITAR-->
                    <!--BOTON ELIMINAR-->
                    <a type="button" href="eliminar.php" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                  </svg></a>
                    <!--FIN BOTON ELIMINAR-->
              </td>
            </tr>
              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
            {{$medidores->links('pagination::bootstrap-4')}}
        <br>
        <!--FIN DE TABLA CON VALORES-->
    </div>

@endsection('content')