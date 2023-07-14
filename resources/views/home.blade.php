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
</style>
<center><h1><strong>CONSULTA DE VALORES A PAGAR</h1></strong></center>
<div class="container">
      <form action="{{route('consulta.index')}}" method="GET">
    <br>
    <br>
       <div class="col-auto">
      <center><input type="text" name="medidor_cedula" id="medidor_cedula" class="form-control" placeholder="Número de medidor o cédula" required></input></center>
      <br>
      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
      <br>
</div>
    </form>
    @if(isset($resultados))
         <!--INICIO TABLA CON DATOS-->
        <table class="table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Medidor</th>
              <th scope="col">Cliente</th>
              <th scope="col">Valor actual</th>
              <th scope="col">Meses en mora</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Última fecha de pago</th>  
              <th scope="col">Estado del servicio</th>  
            </tr>
          </thead>
          <tbody>
            @if(count($resultados)<=0)
            <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach($resultados as $pagosConsultaItem)
            <tr>
              <td class="td_acciones">{{$pagosConsultaItem->numero_medidor}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->nombre}} {{$pagosConsultaItem->apellido}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_actual}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->meses_mora}} meses</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_pagado}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_restante}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->estado_servicio}}</td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
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

        <!--BOTON DE IMPRIMIR-->
        <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->

        <br><br>
    @endif
</div>

@endsection('content')