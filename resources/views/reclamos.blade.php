@extends('layouts.layout_panel')
<title>Gestión de Reclamos | Sistema de Consultas de Valores a Pagar del Agua</title>
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
<center><h1 class="display-4">GESTIÓN DE RECLAMOS</h1></center>
		<div class="container">
			<br>
			<br><br>
        <form action="{{route('reclamos.busqueda')}}" method="GET">
           <div class="col-auto">
            <center><input type="text" class="form-control" name="valores" placeholder="Numero de medidor, planilla o apellidos "></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
        </form>
      <!--INICIO DE MENSAJE DE RESULTADOS-->
          @if(session('resultado'))
          <br>
            <div class="alert alert-success alert-dismissible fade show">
                {{session('resultado')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADOS-->
        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table class="table caption-top table-hover table-responsive table table-bordered table-striped table-sm">
        	  <caption><strong>Consejo: </strong>Para ampliar los detalles del reclamo, haz clic en el nombre del cliente.</caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Cliente</th>
              <th scope="col"># Medidor</th>
              <th scope="col"># Planilla</th>
              <th scope="col">Fecha de reclamo</th>
              <th scope="col">Estado de reclamo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($reclamos)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($reclamos as $reclamosItem)
            <tr>
              <td class="td_acciones">{{$reclamosItem->id}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="{{route('reclamos.show', $reclamosItem)}}">{{$reclamosItem->nombre}} {{$reclamosItem->apellido}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="medidores/busqueda?valores={{$reclamosItem->numero_medidor}}">{{$reclamosItem->numero_medidor}}</a></td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="panel/busqueda?valores={{$reclamosItem->numero_planilla}}">{{$reclamosItem->numero_planilla}}</a></td>
              <td class="td_acciones">{{$reclamosItem->fecha_reclamo}}</td>
              <td class="td_acciones">{{ucFirst($reclamosItem->estado_reclamo)}}</td>
              <!--INICIO DE BOTONES DE ACCIONES-->
              <td class="td_acciones">
              <div class="btn-group">
             @if($reclamosItem->estado_reclamo == "en proceso")
                  <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO RESUELTO-->
                      <a type="button" href="{{route('reclamos.actualizarEstado', $reclamosItem)}}" class="btn btn-outline-success" title="Marcar como resuelto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
                      <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                      <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                      <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
                    </svg></a>
                   <!--FIN ACTUALIZAR ESTADOA A MARCAR COMO EN PROCESO -->
                    @elseif ($reclamosItem->estado_reclamo == "ingresado")
                   <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO-->
                      <a type="button" href="{{route('reclamos.actualizarEstado', $reclamosItem)}}" class="btn btn-outline-success" title="Marcar como en proceso"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                      <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                      <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                    </svg></a>
                   <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO -->
                    @elseif($reclamosItem->estado_reclamo == "resuelto")
                   <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO INGRESADO-->
                      <a type="button" href="{{route('reclamos.actualizarEstado', $reclamosItem)}}" class="btn btn-outline-success" title="Marcar como ingresado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                      <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                      <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                    </svg></a>
                   <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO INGRESADO -->
                   @endif
                  <!--BOTON ELIMINAR RECLAMO-->
                      <a title="Eliminar reclamo" class="btn btn-outline-danger" href="{{route('reclamos.destroy', $reclamosItem )}}" onclick="return confirm('¿Estás seguro de que deseas eliminar el reclamo de {{$reclamosItem->nombre}} {{$reclamosItem->apellido}}?')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg></a>
                  <!--FIN BOTON ELIMINAR RECLAMO-->                 
              </div>   
              </td>
              <!--FIN DE BOTONES DE ACCIONES-->
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
          {{$reclamos->links('pagination::bootstrap-4')}}
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