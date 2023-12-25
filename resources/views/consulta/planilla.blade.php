@extends('layouts.layout_home')
<title>Detalles de Planilla  | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <!--INICIO DE BOTONES-->
        <div class="col-md-12 mb-5 bg-light text-right">
        <!--INICIO DE BOTON DE REGRESAR-->
	        <a href="{{route('home')}}" id="botonRegresar" title="Regresar" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
	          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
	        </svg></a>
        <!--FIN DE BOTON DE REGRESAR--> 
         <!--BOTON DE EXPORTAR A PDF-->
        <button title="Descargar planilla en PDF" id="exportar" class="btn btn-danger float-end" type="button" name="exportar" value="Exportar a PDF"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
          <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
      </svg></button>
      <!--FIN DE BOTON DE EXPORTAR A PDF-->
        </div>
    <!--FIN DE BOTONES-->
       <main class="w-100 m-auto">
        <div id="planilla">
          <!--LOGOTIPO DE INSTITUCION-->
            <center><img class="img-fluid mb-4" width="170" height="50" src="{{url('img/fade_negro_logo.png')}}"></center>
          <!-- FIN DE LOGOTIPO DE INSTITUCION-->
      <!--INICIO DE MENSAJE DE VALORES INEXISTENTES-->
          @if($pagosConsultaItem->valor_actual == 0 && $pagosConsultaItem->estado_servicio == 'activo')
              <div class="alert alert-primary alert-dismissible fade show">
                  <i class="fa-solid fa-circle-exclamation"></i> <strong>ATENCIÓN</strong>. Hasta el momento, la <strong>planilla actual</strong> no cuenta con valores pendientes o aún no se ha registrado el consumo correspondiente a este mes.
              </div>
          @endif
        <!--FIN DE MENSAJE DE VALORES INEXISTENTES-->
        <!--INICIO DE MENSAJE DE ALERTA-->
          @if(isset($pagosConsultaItem))
            @if($pagosConsultaItem->estado_servicio == 'inactivo')
              <div class="alert alert-danger alert-dismissible fade show">
                  <i class="fa-solid fa-triangle-exclamation"></i><strong> ATENCIÓN,</strong> el servicio de agua en su <strong>medidor</strong>, se encuentra suspendido por falta de pago, por favor, acérquese a realizar el pago lo antes posible.
              </div>
              @endif  
          @endif
        <!--FIN DE MENSAJE DE ALERTA-->
        <form class="row g3">
           <div class="col-md-12 mb-2">
            <label for="cliente">Cliente:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
                  <input id="cliente" type="text" value="{{$pagosConsultaItem->cliente->apellido}}, {{$pagosConsultaItem->cliente->nombre}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>
           <div class="col-md-12 mb-2">
            <label for="direccion">Dirección:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span>
                  <input id="direccion" type="text" value="{{$pagosConsultaItem->cliente->direccion}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>              

           <div class="col-md-6 mb-2">
            <label for="planilla">Número de Planilla:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice fa-sm"></i></span>
                  <input id="planilla" type="text" value="{{$pagosConsultaItem->id}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="medidor">Número de Medidor:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>
                  <input id="medidor" type="text" value="{{$pagosConsultaItem->medidor->numero_medidor}}" name="nombre" class="form-control" disabled></input>
              	</div>
              </div>

           <div class="col-md-12 mb-2">
            <label for="categoria_medidor">Categoría:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-house fa-sm"></i></span>
                  <input id="categoria_medidor" type="text" value="{{ucFirst($pagosConsultaItem->medidor->categoria_medidor)}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="consumo_actual" >Consumo actual:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input id="consumo_actual" type="text" value="{{$pagosConsultaItem->consumo->consumo_actual}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>
            <div class="col-md-6 mb-2">
            <label for="consumo_anterior">Consumo anterior:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>
                  <input id="consumo_anterior" type="text" value="{{$pagosConsultaItem->consumo->consumo_anterior}} m³" name="nombre" class="form-control" disabled></input>
                </div>
              </div>
           <div class="col-md-12 mb-2">
            <label for="responsable_lectura">Responsable de lectura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-glasses fa-sm"></i></span>
                  <input id="responsable_lectura" type="text" value="{{$pagosConsultaItem->consumo->responsable}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>
           <div class="col-md-6 mb-2">
            <label for="fecha_factura">Fecha de factura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input type="text" id="fecha_factura" value="{{$pagosConsultaItem->fecha_factura}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="fecha_maxima">Fecha máxima de pago:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input id="fecha_maxima" type="text" value="{{$pagosConsultaItem->fecha_maxima}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

          <div class="col-md-6 mb-2">
            <label for="meses_mora">Meses en mora:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>
                  <input id="meses_mora" type="text" value="{{$pagosConsultaItem->meses_mora}}@if($pagosConsultaItem->meses_mora == 1) mes @else meses @endif" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="estado_servicio">Estado de servicio:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input id="estado_servicio" type="text" value="{{ucFirst($pagosConsultaItem->estado_servicio)}}" name="nombre" class="form-control fw-bold @if ($pagosConsultaItem->estado_servicio == 'activo') text-success border-success @elseif($pagosConsultaItem->estado_servicio == 'inactivo') text-danger border-danger @endif" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label for="agua">Agua:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-droplet fa-sm"></i></span>
                  <input id="agua" type="text" value="$ {{$valorAgua = $pagosConsultaItem->valor_actual - $pagosConsultaItem->alcantarillado - $pagosConsultaItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="alcantarillado">Alcantarillado:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-toilet fa-sm"></i></span>
                  <input id="alcantarillado" type="text" value="$ {{$pagosConsultaItem->alcantarillado}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-6 mb-2">
            <label for="administracion" >Administración:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-wrench fa-sm"></i></span>
                  <input type="text" id="administracion" value="$ {{$pagosConsultaItem->administracion}}" name="nombre" class="form-control" disabled></input>
                </div>
              </div>

           <div class="col-md-12 mb-2">
            <label for="valor_actual">Valor actual (Total a pagar):</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice-dollar fa-sm"></i></span>
                  <input type="text" id="valor_actual" value="$ {{$pagosConsultaItem->valor_actual}}" name="nombre" class="form-control fw-bold" disabled></input>
              	</div>
              </div>
       </form></div>
       <hr>
                 <a href="{{route('reclamos.create', $pagosConsultaItem)}}" title="Ingresar un reclamo"><center><img class="img-fluid mb-4" src="{{url('img/banners/banner_reclamo.png')}}" alt="Ingresar un reclamo"></center></a>
         </main>
        </div> <!--FIN DE CONTENEDOR--> 
  <!--INICIO SCRIPT PARA EXPORTAR A PDF-->
          <script>
              function generarPDF() {
                var element = document.getElementById('planilla');
                  html2pdf(element, {
                    margin: 10,
                    jsPDF: {format:'a4'},
                    filename: 'planilla_{{$pagosConsultaItem->id}}_{{$pagosConsultaItem->fecha_factura}}.pdf',
                    title: '',
                  });
                }
          //Con esto llamaremos al boton para generar el PDF
            var generarBoton = document.getElementById('exportar');
            generarBoton.addEventListener('click', generarPDF);
        </script>
  <!--FIN SCRIPT PARA EXPORTAR A PDF-->
   <!--INICIO SCRIPT PARA REGRESAR-->      
	<script>
	    document.getElementById("botonRegresar").addEventListener("click", function(event) {
	        event.preventDefault(); // Evitar la acción predeterminada
	        window.history.back();  // Regresar a la página anterior
	    });
	</script>
	<!--FIN DE SCRIPT PARA REGRESAR-->
@endsection('content')