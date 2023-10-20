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
              <!--<th scope="col">Consumo previo</th>-->
              <!--<th scope="col">Responsable de lectura</th>-->
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
                    @if(isset($pagosConsultaItem))
                      @if($pagosConsultaItem->estado_servicio == 'inactivo')
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fa-solid fa-triangle-exclamation"></i><strong> ATENCIÓN,</strong> el servicio de agua en su <strong>medidor</strong> #{{$pagosConsultaItem->medidor->numero_medidor}}, se encuentra suspendido por falta de pago, por favor, acérquese a realizar el pago lo antes posible.
                        </div>
                        @endif  
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
              <!--<td class="td_acciones">{{$pagosConsultaItem->consumo->consumo_anterior}} m<sup><strong>3</strong></sup></td>-->
              <!--<td class="td_acciones">{{$pagosConsultaItem->consumo->responsable}}</td>-->
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
            <!--<div class="mt-1 float-start text-muted"><i class="fa-regular fa-lightbulb mb-3"></i><strong> Consejo: </strong>Para ampliar los detalles de la planilla, haz clic en el número de planilla.</div>-->
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
              <script src="{{url('js/main_home.js')}}" defer></script>
        <!--FIN DE SCRIPT DATATABLE-->
    @endif
</div>

@endsection('content')