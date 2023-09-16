@extends('layouts.layout_panel')
<title>Panel de Gestión | Sistema de Consultas de Valores a Pagar del Agua</title>
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
 
   .color_tarjeta
    {
      color: #fff;
    }
    .card:hover{
     transform: scale(1.05);
     box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }  
</style>
<!--CONFIGURACION DE CANVAS JS-->
    @php
      $dataPoints = array(
        array("label"=> "Enero", "y"=> $contarMes[1]),
        array("label"=> "Febrero", "y"=> $contarMes[2]),
        array("label"=> "Marzo", "y"=> $contarMes[3]),
        array("label"=> "Abril", "y"=> $contarMes[4]),
        array("label"=> "Mayo", "y"=> $contarMes[5]),
        array("label"=> "Junio", "y"=> $contarMes[6]),
        array("label"=> "Julio", "y"=> $contarMes[7]),
        array("label"=> "Agosto", "y"=> $contarMes[8]),
        array("label"=> "Septiembre", "y"=> $contarMes[9]),
        array("label"=> "Octubre", "y"=> $contarMes[10]),
        array("label"=> "Noviembre", "y"=> $contarMes[11]),
        array("label"=> "Diciembre", "y"=> $contarMes[12]),
      );
    @endphp
    <script>
      window.onload = function () {   
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title:{
          text: "Pagos realizados en 2023"
        },
        subtitles: [
{          text: "Cantidad de pagos realizados en el presente año"
        }],
        data: [{
          type: "pie",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} - #percent%",
          yValueFormatString: "",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
       
      }
    </script>
<!--FIN DE CONFIGURACION DE CANVAS JS-->
     <!-- Contenido principal -->
      <center><main class="col-md-9">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
          <center><h1 class="display-4">¡Hola de nuevo, {{session()->get('sesion')['nombres']}}!</h1></center>
        </div>
        <div class="row">
       <!--INICIO PLANILLAS-->
       @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
          <div class="col-md-6 mb-2">
              <a href="{{route('planillas.index')}}" title="Planillas" class="link-light link-offset-2 link-underline link-underline-opacity-0">
            <div class="card color_tarjeta" style="background-color:#27ae60;">
              <div class="card-body">
                <h5 class="card-title">Planillas</h5><br>
                <p class="card-text"><h1><i class="fa-solid fa-file-invoice-dollar fa-2xl"></i></p></h1>
                <br>
                <p class="fw-bold mt-2">{{$planillas}} Planillas Ingresadas</p>
              </div>
            </div>
            </a>
          </div>
        @endif  
        <!--FIN DE PLANILLAS-->
        <!--INICIO CLIENTES-->
        @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
          <div class="col-md-6 mb-2">
            <a href="{{route('clientes.index')}}" title="Clientes" class="link-light link-offset-2 link-underline link-underline-opacity-0">
            <div class="card color_tarjeta" style="background-color:#16a085;">
              <div class="card-body">
                <h5 class="card-title">Clientes</h5><br>
                <p class="card-text"><h1><i class="fa-solid fa-circle-user fa-2xl"></i></h1></p>
                <br>
                <p class="fw-bold mt-2">{{$clientes}} Clientes Registrados</p>
              </div>
            </div>
          </a>
          </div>
        @endif  
        <!--FIN DE CLIENTES-->
       <!--INICIO MEDIDORES-->
        @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'administrador')
           @if(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal')<center>@endif
            <div class="col-md-6 mb-2">
              <a href="{{route('medidores.index')}}" title="Medidores" class="link-light link-offset-2 link-underline link-underline-opacity-0">
            <div class="card color_tarjeta" style="background-color:#8e44ad;">
              <div class="card-body">
                <h5 class="card-title">Medidores</h5><br>
                <p class="card-text"><h1><i class="fa-solid fa-gauge fa-2xl" style="color: #ffffff;"></i></h1></p>
                  <br>
                <p class="fw-bold mt-2">{{$medidores}} Medidores Registrados</p>
              </div>
            </div>
          </a>
          </div>@if(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal')</center>@endif
        @endif  
        <!--FIN DE MEDIDORES-->
       <!--INICIO USUARIOS-->
        @if(session()->get('sesion')['rol'] == 'administrador')
          <div class="col-md-6 mb-2">
              <a href="{{route('usuarios.index')}}" title="Usuarios" class="link-light link-offset-2 link-underline link-underline-opacity-0">
            <div class="card color_tarjeta" style="background-color:#3498db;">
              <div class="card-body">
                <h5 class="card-title">Usuarios</h5><br>
                <p class="card-text"><h1><i class="fa-solid fa-users-gear fa-2xl" style="color: #ffffff;"></i></h1>
                    </p>
                    <br>
                <p class="fw-bold mt-2">{{$usuarios}} Usuarios Registrados</p>
              </div>
            </div>
            </a>
          </div>
        @endif     
        <!--FIN DE USUARIOS-->
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"></div>
      </main></center>
      <center><main class="col-md-9">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 class="display-4">Solicitudes pendientes</h1>
        </div>
      <div class="row">
          <!--INICIO MANTENIMIENTOS SOLICITADOS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta">
              <div class="card-body">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                        <div class="badge bg-primary text-wrap">
                            Mantenimientos solicitados
                          </div>                   
                        </div>
                <table class="table-hover table-responsive table table-bordered table-striped table-md">
                  <thead>
                    <tr>
                      <th># Mantenimiento</th>
                      <th>Medidor</th>
                      <th>Fecha de Solicitud</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($mantenimientos)<=0)
                      <center><tr><td colspan="8">No existen mantenimientos solicitados</td></tr></center>
                    @else
                    @foreach($mantenimientos as $mantenimiento)
                      <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="/medidores/mantenimientos/busqueda?valores={{$mantenimiento->id}}">{{$mantenimiento->id}}</a></td>
                      <td class="td_acciones">{{$mantenimiento->medidor->numero_medidor}}</td>
                      <td class="td_acciones">{{$mantenimiento->fecha_solicitud}}</td>
                      @if($mantenimiento->estado_mantenimiento == "solicitado")<td class="td_acciones"><span class="badge text-bg-info">{{ucfirst($mantenimiento->estado_mantenimiento);}}</span></td>@endif
                      @if($mantenimiento->estado_mantenimiento == "en proceso")<td class="td_acciones"><span class="badge text-bg-primary">{{ucfirst($mantenimiento->estado_mantenimiento);}}</span></td>@endif
                      @if($mantenimiento->estado_mantenimiento == "completado")<td class="td_acciones"><span class="badge text-bg-success">{{ucfirst($mantenimiento->estado_mantenimiento);}}</span></td>@endif
                  </tbody>
                  @endforeach
                  @endif
                </table>
              </div>
            </div>
            </div>
          </div>
          <!--FIN MANTENIMIENTOS SOLICITADOS-->
          <!--INICIO RECLAMOS INGRESADOS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta">
              <div class="card-body">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                        <div class="badge bg-info text-wrap">
                            Reclamos ingresados
                          </div>                   
                        </div>
                <table class="table-hover table-responsive table table-bordered table-striped table-md">
                  <thead>
                    <tr>
                      <th># Solicitud</th>
                      <th>Medidor</th>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($reclamos)<=0)
                      <center><tr><td colspan="8">No existen reclamos ingresados</td></tr></center>
                    @else
                    @foreach($reclamos as $reclamo)
                      <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="/reclamos/busqueda?valores={{$reclamo->id}}">{{$reclamo->id}}</a></td>
                      <td class="td_acciones">{{$reclamo->numero_medidor}}</td>
                      <td class="td_acciones">{{$reclamo->apellido}}, {{$reclamo->nombre}}</td>
                      <td class="td_acciones">{{$reclamo->fecha_reclamo}}</td>
                       @if($reclamo->estado_reclamo == "ingresado")<td class="td_acciones"><span class="badge text-bg-info">{{ucfirst($reclamo->estado_reclamo);}}</span></td>@endif
                        @if($reclamo->estado_reclamo == "en proceso")<td class="td_acciones"><span class="badge text-bg-primary">{{ucfirst($reclamo->estado_reclamo);}}</span></td>@endif
                        @if($reclamo->estado_reclamo == "resuelto")<td class="td_acciones"><span class="badge text-bg-success">{{ucfirst($reclamo->estado_reclamo);}}</span></td>@endif
                  </tbody>
                    @endforeach
                  @endif
                </table>
              </div>
            </div>
            </div>
          </div>
          </div>
          <!--FIN RECLAMOS INGRESADOS-->
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"></div>
        </main>
      </center>
      <center><main class="col-md-9">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')
          <h1 class="display-4">Estadisticas</h1>
        </div>
      <div class="row">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
       @endif
    
       </center></main>

<script src="https://cdn.canvasjs.com/canvasjs.min.js" defer></script>
@endsection('content')