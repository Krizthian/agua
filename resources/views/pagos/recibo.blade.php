@extends('layouts.layout_panel')
<title>Recibo de Pago - Gestión de Planillas | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<link rel="stylesheet" type="text/css" media="print" href="{{url('css/recibo.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA RECIBO*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;   
	     }
	     .container-recibo{
			  --mask: 
			    conic-gradient(from 150deg at top,#0000,#000 1deg 59deg,#0000 60deg) top/34.64px 51% repeat-x,
			    conic-gradient(from -30deg at bottom,#0000,#000 1deg 59deg,#0000 60deg) bottom/34.64px 51% repeat-x;
			  -webkit-mask: var(--mask);
			          mask: var(--mask);
			    padding-bottom: 80px;
			    padding-top: 60px; 
			}
    </style>
<div id="print-container">
<center><h1 class="mt-0 display-4">Recibo de Pago</center></h1>
<main class="form-signin w-100 m-auto">
		<div class="container container-recibo"> <!--INICIO DE CONTENEDOR--> 
			<center><img class="img-fluid" width="170" height="50" src="{{url('img/negro_logo.png')}}" alt="Logotipo de Portovelo"></center>
			<form class="text-center">
				<strong><label>Recibo: </label></strong> #{{$numero_recibo}}
				<br>
				<strong><label>Cliente: </label></strong> {{$nombre_cliente}} {{$apellido_cliente}}
				<br>
				<strong><label>Planilla: </label></strong> #{{$id_planilla}}
				<br>
				<strong><label>Medidor: </label></strong> #{{$medidor_pagado}}
				<br>
				<strong><label>Valor a pagar: </label></strong> $ {{$valor_a_pagar}}
				<br>
				<strong><label>Valor pagado: </label></strong> $ {{$valor_pagado}}
				<br>
				<strong><label>Forma de pago: </label></strong> {{ucFirst($forma_pago)}}
				<br>
				<strong><label>Cajero: </label></strong> {{$cajero}}
				<br>
				<strong><label>Fecha: </label></strong> {{$fecha}}
			</form>
	<div id="botones">
		<!--BOTON DE REGRESAR-->
		<div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('pagos.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
        </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
        <!--BOTON DE EXPORTAR A PDF-->
        <div class="col-md-12 bg-light text-right"><button title="Descargar recibo en PDF" id="exportar" class="btn btn-danger float-end" type="button" name="exportar" value="Exportar a PDF"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
	  	<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
	  	<path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
		</svg></button></div>
	</div>
        <!--FIN DE BOTON DE EXPORTAR A PDF-->
        <script>
        	function generarPDF() {
	        	var element = document.getElementById('print-container');
				html2pdf(element, {
					ignore: ['#botones'],
					jsPDF: {format:'a6'},
					filename: 'recibo_{{$numero_recibo}}.pdf',
				});
			}
			    //Con esto llamaremos al boton para generar el PDF
				    var generarBoton = document.getElementById('exportar');
				    generarBoton.addEventListener('click', generarPDF);
        </script>
			</div> <!--FIN DE CONTENEDOR-->
	</main>
</div>
@endsection('content')