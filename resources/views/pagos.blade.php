@extends('layouts.layout_panel')
<title>Historial de Pagos | Sistema de Consultas de Valores a Pagar del Agua</title>
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
<center><h1 class="display-4">HISTORIAL DE PAGOS</h1></center>
		<div class="container">
			<br>
      <!--BOTON DE REGRESAR-->
            <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('panel.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
	        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
	        </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->
			<br><br>
        <form action="{{route('pagos.busqueda')}}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="valores" placeholder="Apellidos o cédula" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>

        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Cliente</th>
              <th scope="col"># Medidor</th>
              <th scope="col"># Planilla</th>
              <th scope="col">Valor pagado</th>
              <th scope="col">Valor restante</th>
              <th scope="col">Fecha de pago</th>
              <th scope="col">Forma de pago</th>
            </tr>
          </thead>
          <tbody>
            @if(count($pagos)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($pagos as $pagosItem)
            <tr>
              <td class="td_acciones">{{$pagosItem->id}}</td>
              <td class="td_acciones">{{$pagosItem->cliente->nombre}} {{$pagosItem->cliente->apellido}}</td>
              <td class="td_acciones">{{$pagosItem->planilla->medidor->numero_medidor}}</td>
              <td class="td_acciones"><a href="/panel/busqueda?valores={{$pagosItem->planilla->id}}" class="link link-offset-2 link-underline link-underline-opacity-0">{{$pagosItem->planilla->id}}</a></td>
              <td class="td_acciones">{{$pagosItem->valor_pagado}}</td>
              <td class="td_acciones">{{$pagosItem->valor_restante}}</td>
              <td class="td_acciones">{{$pagosItem->fecha_pago}}</td>
              <td class="td_acciones">{{ucfirst($pagosItem->forma_pago)}}</td>
            </tr>
              </td>
            </tr> 
            @endforeach
            @endif
          </tbody>
            </div>
        </table>
      </div>
        <!--FIN DE TABLA CON VALORES-->
          {{$pagos->links('pagination::bootstrap-4')}}
        <!--BOTON DE IMPRIMIR-->
          <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
          </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->
        <br><br>
      </div>  
      </div>  


@endsection('content')