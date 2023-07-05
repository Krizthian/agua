@extends('layouts.layout_panel')

@section('content')
<style>
	/*ESTILO PERSONALIZADO PARA PANEL DE GESTION (PAGINA DE INICIO)*/
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
                <center><a type="button" href="registrar_pago.php" class="btn btn-outline-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" valuviewBox="0 0 16 16">
			 	 <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
			</svg>Registrar Pago</a></center>
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