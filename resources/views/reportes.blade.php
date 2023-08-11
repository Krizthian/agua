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
    <script>
      /*FUNCION JAVASCRIPT PARA DESHABILITAR CAMPOS CUANDO SE ELIJA UN REPORTE DE MEDIDORES*/
        document.addEventListener('DOMContentLoaded', function() {
            const tipoSelect = document.getElementById('tipo');
            const mesSelect = document.getElementById('mes');
            const yearSelect = document.getElementById('year');
            
            tipoSelect.addEventListener('change', function() {
                if (tipoSelect.value === 'medidores_activos' || tipoSelect.value === 'medidores_inactivos') {
                    mesSelect.disabled = true;
                    yearSelect.disabled = true;
                }else{
                    mesSelect.disabled = false;
                    yearSelect.disabled = false;
                }
            });
        });
    </script>

<center><h1 class="display-4">GESTIÓN DE REPORTES</h1></center>
  <div class="container">
	  <br>
	    <center><label><strong>Tipo de Reporte</strong></label></center>
        <form action="{{route('reportes.generar')}}" method="GET">
          <div class="form-group">
          <select class="form-select" id="tipo" name="tipo" required>
            <option value="" disabled selected>Seleccione un tipo de reporte</option>
            @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')<option value="pagos">Pagos</option>@endif
            <option value="mantenimientos">Mantenimientos</option>
            <option value="reclamos">Reclamos</option>
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
          <select class="form-select" id="year" name="year" required>
            <option value="" disabled selected>Seleccione un año</option>
            <option>{{date("Y")}}</option>
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

  <!--INICIO DE VALORES DE REPORTE DE PAGOS-->          
    @if($query)  
     <div class="table-responsive"> 
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Número de Medidor</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Última fecha de pago</th>
              <th scope="col">Estado de servicio</th>
            </tr>
          </thead>
          <tbody>
        @if(count($query)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($query as $valorGenerado)
            <tr>
              <td class="td_acciones">{{$valorGenerado->cliente->nombre}} {{$valorGenerado->cliente->apellido}}</td>
              <td class="td_acciones">{{$valorGenerado->planilla->medidor->numero_medidor}}</td>
              <td class="td_acciones">$ {{$valorGenerado->valor_pagado}}</td>
              <td class="td_acciones">$ {{$valorGenerado->valor_restante}}</td>
              <td class="td_acciones">{{$valorGenerado->fecha_pago}}</td>
              <td class="td_acciones">{{ucfirst($valorGenerado->planilla->estado_servicio)}}</td>
            </tr> 
          @endforeach
          @endif
       @endif
        </tbody>
      </table>
    </div>
    @endif
     <!--FIN DE VALORES DE REPORTE DE PAGOS-->

<!--INICIO DE VALORES DE REPORTE DE MANTENIMIENTOS-->          
    @isset($queryMantenimientos)  
     <div class="table-responsive"> 
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Número de Medidor</th>
              <th scope="col">Propietario</th>
              <th scope="col">Fecha de Solicitud</th>
              <th scope="col">Fecha para Mantenimiento</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Responsable Asignado</th>
              <th scope="col">Estado de Mantenimiento</th>
            </tr>
          </thead>
          <tbody>
        @if(count($queryMantenimientos)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($queryMantenimientos as $queryMantenimientosItem)
            <tr>
              <td class="td_acciones">{{$queryMantenimientosItem->medidor->numero_medidor}}</td>
              <td class="td_acciones">{{$queryMantenimientosItem->medidor->cliente->nombre}} {{$queryMantenimientosItem->medidor->cliente->apellido}}</td>
              <td class="td_acciones">{{$queryMantenimientosItem->fecha_solicitud}}</td>
              <td class="td_acciones">{{$queryMantenimientosItem->fecha_mantenimiento}}</td>
              <td class="td_acciones">{{$queryMantenimientosItem->medidor->ubicacion}}</td>
              <td class="td_acciones">{{$queryMantenimientosItem->responsable_asignado}}</td>
              <td class="td_acciones">{{ucFirst($queryMantenimientosItem->estado_mantenimiento)}}</td>
            </tr> 
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
        @endisset
     <!--FIN DE VALORES DE REPORTE DE MANTENIMIENTOS-->

<!--INICIO DE VALORES DE REPORTE DE RECLAMOS-->          
    @isset($queryReclamos)  
     <div class="table-responsive"> 
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col"># Medidor</th>
              <th scope="col"># Planilla</th>
              <th scope="col">Fecha de reclamo</th>
              <th scope="col">Estado de reclamo</th>
            </tr>
          </thead>
          <tbody>
        @if(count($queryReclamos)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($queryReclamos as $queryReclamosItem)
            <tr>
              <td class="td_acciones">{{$queryReclamosItem->nombre}} {{$queryReclamosItem->apellido}}</td>
              <td class="td_acciones">{{$queryReclamosItem->numero_medidor}}</td>
              <td class="td_acciones">{{$queryReclamosItem->numero_planilla}}</td>
              <td class="td_acciones">{{$queryReclamosItem->fecha_reclamo}}</td>
              <td class="td_acciones">{{ucFirst($queryReclamosItem->estado_reclamo)}}</td>
            </tr> 
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
        @endisset
     <!--FIN DE VALORES DE REPORTE DE RECLAMOS-->

  <!--INICIO DE VALORES DE REPORTE DE MEDIDORES INACTIVOS-->          
    @isset($queryMedidoresInactivos)  
     <div class="table-responsive"> 
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Número de Medidor</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Estado de servicio</th>
            </tr>
          </thead>
          <tbody>
        @if(count($queryMedidoresInactivos)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($queryMedidoresInactivos as $valorGenerado)
            <tr>
              <td class="td_acciones">{{$valorGenerado->cliente->nombre}} {{$valorGenerado->cliente->apellido}}</td>
              <td class="td_acciones">{{$valorGenerado->medidor->numero_medidor}}</td>
              <td class="td_acciones">{{$valorGenerado->medidor->ubicacion}}</td>
              <td class="td_acciones">{{ucfirst($valorGenerado->estado_servicio)}}</td>
            </tr> 
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
        @endisset
     <!--FIN DE VALORES DE REPORTE DE MEDIDORES INACTIVOS-->

  <!--INICIO DE VALORES DE REPORTE DE MEDIDORES ACTIVOS-->          
    @isset($queryMedidoresActivos)  
     <div class="table-responsive"> 
      <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Número de Medidor</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Estado de servicio</th>
            </tr>
          </thead>
          <tbody>
        @if(count($queryMedidoresActivos)<=0)
          <center><tr><td colspan="8">No se han encontrado resultados dentro de las fechas establecidas</td></tr></center>
        @else  
          @foreach ($queryMedidoresActivos as $valorGenerado)
            <tr>
              <td class="td_acciones">{{$valorGenerado->cliente->nombre}} {{$valorGenerado->cliente->apellido}}</td>
              <td class="td_acciones">{{$valorGenerado->medidor->numero_medidor}}</td>
              <td class="td_acciones">{{$valorGenerado->medidor->ubicacion}}</td>
              <td class="td_acciones">{{ucfirst($valorGenerado->estado_servicio)}}</td>
            </tr> 
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
        @endisset
        <br>
     <!--FIN DE VALORES DE REPORTE DE MEDIDORES ACTIVOS-->
</div>
      <!--SCRIPT DATATABLE-->
        <script src="{{url('js/main.js')}}"></script>
      <!--FIN DE SCRIPT DATATABLE-->  
</div>

@endsection('content')