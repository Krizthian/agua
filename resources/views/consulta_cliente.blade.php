@extends('layouts.layout_home')
<title>Inicio | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<center><h1><strong>CONSULTA DE VALORES A PAGAR</h1></strong></center>
<div class="container">
      <form action="{{route('consulta_cliente.index')}}" method="GET">
    <br>
    <br>
       <div class="col-auto">
      <center><input type="text" name="medidor_cedula" id="medidor_cedula" class="form-control" placeholder="{{$texto}}" required></input></center>
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
           
            </tr>
          </thead>
          <tbody>
            @if(count($pagos_consulta)<=0)
            <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach($pagos_consulta as $pagosConsultaItem)
            <tr>
              <td class="td_acciones">{{$pagosConsultaItem->numero_medidor}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->cedula}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_actual}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->meses_mora}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_pagado}}</td>
              <td class="td_acciones">$ {{$pagosConsultaItem->valor_restante}}</td>
              <td class="td_acciones">{{$pagosConsultaItem->fecha}}</td>
            </tr> 
            @endforeach
            @endif
          </tbody>
        </table>
        <br>
</div>

@endsection('content')