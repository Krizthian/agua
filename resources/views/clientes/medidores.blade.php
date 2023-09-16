@extends('layouts.layout_panel')
<title>Medidores de {{$clientesItem->nombre}} {{$clientesItem->apellido}} | Sistema de Consultas de Valores a Pagar del Agua</title>
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

<center><h1 class="display-4">Medidores de {{$clientesItem->nombre}} {{$clientesItem->apellido}}</h1></center>
    <div class="container">
        <br>
            <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('clientes.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg></a></div>
        <br><br>
        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Número de Medidor</th>
              <th scope="col">Fecha de Instalación</th>
              <th scope="col">Ubicacion</th>
              <th scope="col">Consumo Actual</th>
            </tr>
          </thead>
          <tbody>
            @if(count($medidores)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($medidores as $medidoresItem)
            <tr>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="/medidores/busqueda?valores={{$medidoresItem->numero_medidor}}">{{$medidoresItem->numero_medidor}}</a></td>
              <td class="td_acciones">{{$medidoresItem->fecha_instalacion}}</td>
              <td class="td_acciones">{{$medidoresItem->ubicacion}}</td>
              @isset($medidoresItem->consumo)
              <td class="td_acciones">{{$medidoresItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              @else
               <td class="td_acciones text-muted">N/D</td>
              @endisset
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
        <!--SCRIPT DATATABLE-->
          <script src="{{url('js/main.js')}}" defer></script>
         <!--FIN DE SCRIPT DATATABLE--> 
        <br><br>
    </div>

@endsection('content')