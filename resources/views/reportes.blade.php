@extends('layouts.layout_panel')
<title>Gestión de Reportes | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
	<style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (REPORTES)*/
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

<center><h1><strong>GESTIÓN DE REPORTES</h1></strong></center>
  <div class="container">
	  <br>
	    <center><label><strong>Tipo de Reporte</strong></label></center>
        <form action="{{route('reportes.generar')}}" method="GET">
          <div class="form-group">
          <select class="form-select" id="tipo" name="tipo" required>
            <option value="" disabled selected>Seleccione un tipo de reporte</option>
            <option value="pagos">Pagos</option>
            <option value="medidores_activos">Medidores Activos</option>
            <option value="medidores_inactivos">Medidores Inactivos</option>
  </select>
  <br>
          <center><label><strong>Mes</strong></label></center>
          <div class="form-group">
          <select class="form-select" id="mes" name="mes">
            <option value="" disabled selected>Seleccione un mes</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
  </select>
  </div>

    <br>
          <center><label><strong>Año</strong></label></center>
          <div class="form-group">
          <select class="form-select" id="year" name="year" >
            <option value="" disabled selected>Seleccione un año</option>
            <option>2023</option>
            <option>2022</option>
            <option>2021</option>
            <option>2020</option>
            <option>2019</option>
            <option>2018</option>
            <option>2017</option>
            <option>2016</option>
            <option>2015</option>
            <option>2014</option>
            <option>2013</option>
            <option>2012</option>
  </select>
</div>
<br>
      <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
        </form>
        <br>
      @if(isset($query))
    <!--INICIO TABLA CON DATOS-->
      <!--INICIO BOTON DE IMPRIMIR-->
          <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
          </svg></button></div>
          <br><br>
      <!--FIN BOTON DE IMPRIMIR-->
      <table class="table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Medidor</th>
              <th scope="col">Cliente</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Última fecha de pago</th>
              <th scope="col">Estado del servicio</th>       
            </tr>
          </thead>
          <tbody>
        @if(count($query)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($query as $valorGenerado)
            <tr>
              <td class="td_acciones">{{$valorGenerado->numero_medidor}}</td>
              <td class="td_acciones">{{$valorGenerado->nombre}} {{$valorGenerado->apellido}}</td>
              <td class="td_acciones">{{$valorGenerado->valor_pagado}}</td>
              <td class="td_acciones">{{$valorGenerado->valor_restante}}</td>
              <td class="td_acciones">{{$valorGenerado->fecha}}</td>
              <td class="td_acciones">{{ucfirst($valorGenerado->estado_servicio);}}</td>
            </tr> 
          @endforeach
          @endif
        </tbody>
      </table>
        @endif
</div>

</div>

@endsection('content')