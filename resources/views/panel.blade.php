@extends('layout_panel')

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
		</div>
@endsection('content')