@extends('layouts.layout_home')
<title>Inicio | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<center><h1><strong>CONSULTA DE VALORES A PAGAR</h1></strong></center>
<div class="container">
      <form action="{{route('consulta_cliente.index')}}" method="GET">
        @csrf
    <br>
    <br>
       <div class="col-auto">
      <center><input type="text" name="medidor_cedula" id="medidor_cedula" class="form-control" placeholder="Número de medidor o cédula" required></input></center>
      <br>
      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
      <br>
</div>
    </form>
</div>

@endsection('content')