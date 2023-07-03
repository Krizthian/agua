@extends('layouts.layout_panel')

@section('content')
	<style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (REPORTES)*/
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

<center><h1><strong>GESTIÓN DE REPORTES</h1></strong></center>
  <div class="container">
	  <br>
	    <center><label><strong>Tipo de Reporte</strong></label></center>
        <form action="php/consulta_reporte.php" method="GET">
          <div class="form-group">
          <select class="form-select" id="tipo" name="tipo">
            <option>Pagos</option>
            <option>Deudores</option>
  </select>
  <br>
          <center><label><strong>Mes</strong></label></center>
          <div class="form-group">
          <select class="form-select" id="mes" name="mes">
            <option>Enero</option>
            <option>Febrero</option>
            <option>Marzo</option>
            <option>Abril</option>
            <option>Mayo</option>
            <option>Junio</option>
            <option>Julio</option>
            <option>Agosto</option>
            <option>Septiembre</option>
            <option>Octubre</option>
            <option>Noviembre</option>
            <option>Diciembre</option>
  </select>
</div>
<br>
      <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
        </form>
        <br>   
</div>
</div>

@endsection('content')