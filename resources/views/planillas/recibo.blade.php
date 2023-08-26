@extends('layouts.layout_panel')
<title>Recibo de Pago - Gestión de Planillas | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<link rel="stylesheet" type="text/css" media="print" href="{{url('css/recibo.css')}}">
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
			<form class="text-center">
		<strong><label>Recibo: </label></strong> {{$numero_recibo}}
		<br>
		<strong><label>Cliente: </label></strong> {{$nombre_cliente}} {{$apellido_cliente}}
		<br>
		<strong><label>Planilla: </label></strong> # {{$id_planilla}}
		<br>
		<strong><label>Medidor: </label></strong> # {{$medidor_pagado}}
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
		<!--<main class="form-signin w-100 m-auto"><div class="alert alert-success alert-dismissible fade show">El pago ha sido ingresado correctamente, no olvides imprimir el recibo y entregarlo al cliente.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
		</div></main>-->
		</form>
		<!--BOTON DE REGRESAR-->
			<div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('panel.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
        <!--BOTON DE IMPRIMIR-->
        <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->
			</div> <!--FIN DE CONTENEDOR-->
	</main>
</div>
@endsection('content')