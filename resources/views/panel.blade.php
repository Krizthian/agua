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
			    <form>
			       <div class="col-auto">
			      <center><input type="text" class="form-control" placeholder="Nombres, número de medidor o cédula"></input></center>
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
              <th scope="col">Cedula</th>
              <th scope="col">Valor actual</th>
              <th scope="col">Meses en mora</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Ultima fecha de pago</th>
              <center><th scope="col">Acciones</th></center>
           
            </tr>
          </thead>
          <tbody>
          	@if($valores_pagar)
          		@foreach ($valores_pagar as $valoresPagarItem)
            <tr>
              <td class="td_acciones">{{$valoresPagarItem->numero_medidor}}</td>
              <td class="td_acciones">{{$valoresPagarItem->cedula}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_actual}}</td>
              <td class="td_acciones">{{$valoresPagarItem->meses_mora}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_pagado}}</td>
              <td class="td_acciones">$ {{$valoresPagarItem->valor_restante}}</td>
              <td class="td_acciones">{{$valoresPagarItem->fecha}}</td>
              <td class="td_acciones">
                <!--BOTON REGISTRAR PAGO-->
                <a type="button" href="registrar_pago.php" class="btn btn-outline-success">Registrar Pago</a>
                <!--FIN BOTON REGISTRAR PAGO-->

              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
        	{{$valores_pagar->links('pagination::bootstrap-4')}}
        <br>
      <!--FIN TABLA CON DATOS-->

		</div>
@endsection('content')