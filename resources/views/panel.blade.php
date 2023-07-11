@extends('layouts.layout_panel')
<title>Panel de Consulta | Sistema de Consultas de Valores a Pagar del Agua</title>
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
			<br><br>
			    <form action="{{route('panel.busqueda')}}" method="GET">
			       <div class="col-auto">
			      <center><input type="text" name="valores" class="form-control" placeholder="Apellidos, número de medidor o cédula"></input></center>
			      <br>
			      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
			      <br>
				</div>
    </form>

    <!--INICIO TABLA CON DATOS-->
    	<table class=" table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Medidor</th>
              <th scope="col">Cédula</th>
              <th scope="col">Cliente</th>
              <th scope="col">Valor actual</th>
              <th scope="col">Meses en mora</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Última fecha de pago</th>
              <th scope="col">Estado del servicio</th>
              <th scope="col" align="center">Acciones</th>        
            </tr>
          </thead>
          <tbody>
          	@if($valores_pagar)
          		@foreach ($valores_pagar as $valoresPagarItem)
            <tr>
              <td class="td_acciones">{{$valoresPagarItem->numero_medidor}}</td>
              <td class="td_acciones">{{$valoresPagarItem->cedula}}</td>
              <td class="td_acciones">{{$valoresPagarItem->nombre}} {{$valoresPagarItem->apellido}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_actual}}</td>
              <td class="td_acciones">{{$valoresPagarItem->meses_mora}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_pagado}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_restante}}</td>
              <td class="td_acciones">{{$valoresPagarItem->fecha}}</td>
              <td class="td_acciones">{{$valoresPagarItem->estado_servicio}}</td>
              <td class="td_acciones">
                <!--BOTON PAGAR-->
                    <a type="button" href="pagar.php" class="btn btn-outline-success" title="Registrar pago"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                      <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                    </svg></a>
                    <!--FIN BOTON PAGAR-->
                    <!--BOTON CORTAR SERVICIO-->
                    <a type="button" href="cortar.php" class="btn btn-outline-danger" title="Suspender servicio"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg></a>
                    <!--FIN BOTON CORTAR SERVICIO-->

              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
        	{{$valores_pagar->links('pagination::bootstrap-4')}}
      <!--FIN TABLA CON DATOS-->
        <!--BOTON DE IMPRIMIR-->
        <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->
<br><br>
		</div>
@endsection('content')