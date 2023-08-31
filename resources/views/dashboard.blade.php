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

    }   
</style>
     <!-- Contenido principal -->
      <center><main class="col-md-9">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <center><h1 class="display-4">¡Hola de nuevo!</h1></center>
        </div>
        
        <!-- Aquí puedes agregar tus widgets, tablas, gráficos, etc. -->
        <div class="row">
          <!--INICIO WIDGETS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta" style="background-color:#3498db;">
              <div class="card-body">
                <h5 class="card-title">Widget 1</h5><br>
                <p class="card-text">                <h1><i class="fa-solid fa-circle-user fa-2xl" style="color: #ffffff;"></i></h1>
</p>
<br>
<p>wfjewfj</p>
              </div>
            </div>
          </div>
        <!--FIN DE WIDGETS-->
       <!--INICIO WIDGETS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta" style="background-color:#34495e;">
              <div class="card-body">
                <h5 class="card-title">Widget 1</h5>
                <p class="card-text">Contenido del widget.</p>
              </div>
            </div>
          </div>
        <!--FIN DE WIDGETS-->
       <!--INICIO WIDGETS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta" style="background-color:#27ae60;">
              <div class="card-body">
                <h5 class="card-title">Widget 1</h5>
                <p class="card-text">Contenido del widget.</p>
              </div>
            </div>
          </div>
        <!--FIN DE WIDGETS-->
               <!--INICIO WIDGETS-->
          <div class="col-md-6 mb-2">
            <div class="card color_tarjeta" style="background-color:#9b59b6;">
              <div class="card-body">
                <h5 class="card-title">Widget 1</h5>
                <p class="card-text">Contenido del widget.</p>
              </div>
            </div>
          </div>
        <!--FIN DE WIDGETS-->
        </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

      </main></center>
@endsection('content')