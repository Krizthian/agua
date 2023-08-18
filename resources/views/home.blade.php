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
                Se ha ingresado el reclamo correctamente.
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
      <form action="{{route('consulta.index')}}" method="POST">
        @csrf
       <div class="col-auto">
      <label for="medidor_cedula" hidden>Formulario de busqueda:</label><center><input type="text" name="medidor_cedula" id="medidor_cedula" class="form-control" placeholder="Número de medidor, planilla o cédula" required></input></center>
      <br>
      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
      <br>
</div>
    </form>
    @if(!isset($resultados))
      </div>
      <center><div class="container-fluid mt-5">
        <div class="image-container d-flex justify-content-center align-items-center ">
        <a href="{{route('calculadora.index')}}">
          <img title="Calculadora de valores" alt="Calculadora de valores" class="img-fluid mt-4" src="{{url('img/banners/CalculadoraBanner.png')}}">
        </a>
      </div>
    </div></center>
    @endif
    @if(isset($resultados))
         <!--INICIO TABLA CON DATOS-->
      <div class="table-responsive">
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Planilla</th>
              <th scope="col">Medidor</th>
              <th scope="col">Cédula</th>
              <th scope="col">Cliente</th>
              <th scope="col">Valor actual</th>
              <th scope="col">Consumo actual</th>
              <th scope="col">Consumo previo</th>
              <th scope="col">Responsable de lectura</th>
              <th scope="col">Fecha de Factura</th>
              <th scope="col">Fecha máxima de pago</th>
              <th scope="col">Estado del servicio</th>  
            </tr>
          </thead>
          <tbody>
            @if(count($resultados)<=0)
            <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach($resultados as $pagosConsultaItem)
            <tr>
              <td class="td_acciones">{{$pagosConsultaItem->id}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->medidor->numero_medidor}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->cliente->cedula}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->cliente->nombre}} {{$pagosConsultaItem->cliente->apellido}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_actual}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$pagosConsultaItem->consumo->consumo_anterior}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$pagosConsultaItem->consumo->responsable}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha_factura}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha_maxima}}</td>
               @if($pagosConsultaItem->estado_servicio == "activo")<td class="td_acciones"><span class="badge rounded-pill text-bg-success">{{ucfirst($pagosConsultaItem->estado_servicio);}}</span></td>@endif
               @if($pagosConsultaItem->estado_servicio == "inactivo")<td class="td_acciones"><span class="badge rounded-pill text-bg-danger">{{ucfirst($pagosConsultaItem->estado_servicio);}}</span></td>@endif
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
        <!--FIN DE LA TABLA CON DATOS-->

        <!--INICIO DE MENSAJE DE ALERTA-->
        @if(isset($pagosConsultaItem))
        @if($pagosConsultaItem->estado_servicio == 'inactivo')
          <div class="alert alert-danger alert-dismissible fade show">
              <strong>ATENCIÓN,</strong> el servicio de agua en su <strong>medidor</strong>, se encuentra suspendido por falta de pago, por favor, acerquese a realizar el pago lo antes posible.
          </div>
          @endif  
        @endif
        <!--FIN DE MENSAJE DE ALERTA-->
        <br>
       <!--INICIO DE BANNER DE RECLAMO-->
        @isset ($pagosConsultaItem)
          <a href="{{route('reclamos.create', $pagosConsultaItem)}}" title="Ingresar un reclamo"><center><img class="img-fluid" src="{{url('img/banners/banner_reclamo.png')}}" alt="Ingresar un reclamo"></center></a>
       @endisset
        <br>  
        <!--SCRIPT DATATABLE-->
          <script src="{{url('js/main_home.js')}}"></script>
        <!--FIN DE SCRIPT DATATABLE-->
        <!--FIN DE BANNER DE RECLAMO-->
    @endif

</div>

@endsection('content')