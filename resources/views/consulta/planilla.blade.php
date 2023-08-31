@extends('layouts.layout_home')
<title>Detalles de Planilla  | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">Detalles de Planilla</h1></center>
    <div class="container"> <!--INICIO DE CONTENEDOR-->  
        <br>
        <!--INICIO DE BOTON DE REGRESAR-->
	        <div class="col-md-12 mb-5 bg-light text-right"><a href="{{route('home')}}" id="botonRegresar" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
	          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
	        </svg></a>
        <!--FIN DE BOTON DE REGRESAR--> 
         <!--BOTON DE IMPRIMIR-->
          <button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
          </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->
        <!--INICIO DE MENSAJE DE ALERTA-->
	        @if(isset($pagosConsultaItem))
		        @if($pagosConsultaItem->estado_servicio == 'inactivo')
		          <div class="alert alert-danger alert-dismissible fade show">
		              <strong>ATENCIÓN,</strong> el servicio de agua en su <strong>medidor</strong>, se encuentra suspendido por falta de pago, por favor, acérquese a realizar el pago lo antes posible.
		          </div>
		          @endif  
	        @endif
        <!--FIN DE MENSAJE DE ALERTA-->
       <main class="w-100 m-auto">
        <form class="row g3">
           <div class="col-md-12 mb-2">
            <label>Cliente:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->cliente->apellido}}, {{$pagosConsultaItem->cliente->nombre}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>
           <div class="col-md-12 mb-2">
            <label>Dirección:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->cliente->direccion}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>              

           <div class="col-md-6 mb-2">
            <label>Número de Planilla:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->id}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Número de Medidor:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->medidor->numero_medidor}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Consumo actual:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->consumo->consumo_actual}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

            <div class="col-md-6 mb-2">
            <label>Consumo anterior:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->consumo->consumo_anterior}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label>Agua:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input type="text" value="$ {{$valorAgua = $pagosConsultaItem->valor_actual - $pagosConsultaItem->alcantarillado - $pagosConsultaItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Alcantarillado:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-toilet fa-sm"></i></span>
                  <input type="text" value="$ {{$pagosConsultaItem->alcantarillado}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Administración:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-wrench fa-sm"></i></span>
                  <input type="text" value="$ {{$pagosConsultaItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label>Valor actual (Total a pagar):</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice-dollar fa-sm"></i></span>
                  <input type="text" value="$ {{$pagosConsultaItem->valor_actual}}" name="nombre" class="form-control fw-bold" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Meses en mora:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->meses_mora}}@if($pagosConsultaItem->meses_mora == 1) mes @else meses @endif" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Fecha de factura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->fecha_factura}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Fecha máxima de pago:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->fecha_maxima}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label>Estado de servicio:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input type="text" value="{{ucFirst($pagosConsultaItem->estado_servicio)}}" name="nombre" class="form-control fw-bold @if ($pagosConsultaItem->estado_servicio == 'activo') text-success border-success @elseif($pagosConsultaItem->estado_servicio == 'inactivo') text-danger border-danger @endif" disabled></input>
              	</div>
              </div>
           <div class="col-md-12 mb-2">
            <label>Responsable de lectura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-glasses fa-sm"></i></span>
                  <input type="text" value="{{$pagosConsultaItem->consumo->responsable}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>
       </form>
                 <a href="{{route('reclamos.create', $pagosConsultaItem)}}" title="Ingresar un reclamo"><center><img class="img-fluid mb-4" src="{{url('img/banners/banner_reclamo.png')}}" alt="Ingresar un reclamo"></center></a>
         </main>
        </div> <!--FIN DE CONTENEDOR--> 
   <!--INICIO SCRIPT PARA REGRESAR-->      
	<script>
	    document.getElementById("botonRegresar").addEventListener("click", function(event) {
	        event.preventDefault(); // Evitar la acción predeterminada
	        window.history.back();  // Regresar a la página anterior
	    });
	</script>
	<!--FIN DE SCRIPT PARA REGRESAR-->
@endsection('content')