@extends('layouts.layout_panel')
<title>Historial de Mantenimientos | Sistema de Consultas de Valores a Pagar del Agua</title>
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
<center><h1 class="display-4">HISTORIAL DE MANTENIMIENTOS</h1></center>
		<div class="container">
			<br>
      @if(request()->routeIs('mantenimientos.busqueda'))
        <!--BOTON DE REGRESAR-->
            <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('mantenimientos.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
        @elseif(request()->routeIs('mantenimientos.index')) 
        <!--BOTON DE REGRESAR-->
            <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->
      @endif
			<br><br>
        <form action="{{route('mantenimientos.busqueda')}}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="valores" placeholder="Número de medidor" aria-label="Buscar" required>
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></button>
        </form>
      <!--INICIO DE MENSAJE DE RESULTADOS-->
          @if(session('resultado_creacion'))
            <div class="alert alert-success alert-dismissible fade show">
                {{session('resultado_creacion')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADOS-->
        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table id="tabla" class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"># Medidor</th>
              <th scope="col">Fecha de Solicitud</th>
              <th scope="col">Fecha para Mantenimiento</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Responsable Asignado</th>
              <th scope="col">Estado de Mantenimiento</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @if(count($mantenimientos)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
            @else
                @foreach ($mantenimientos as $mantenimientosItem)
            <tr>
              <td class="td_acciones">{{$mantenimientosItem->id}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="/medidores/busqueda?valores={{$mantenimientosItem->medidor->numero_medidor}}">{{$mantenimientosItem->medidor->numero_medidor}}</a></td>
              <td class="td_acciones">{{$mantenimientosItem->fecha_solicitud}}</td>
              <td class="td_acciones">{{$mantenimientosItem->fecha_mantenimiento}}</td>
              <td class="td_acciones">{{$mantenimientosItem->medidor->ubicacion}}</td>
              <td class="td_acciones">{{$mantenimientosItem->responsable_asignado}}</td>
              @if($mantenimientosItem->estado_mantenimiento == "solicitado")<td class="td_acciones"><span class="badge rounded-pill text-bg-info">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              @if($mantenimientosItem->estado_mantenimiento == "en proceso")<td class="td_acciones"><span class="badge rounded-pill text-bg-primary">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              @if($mantenimientosItem->estado_mantenimiento == "completado")<td class="td_acciones"><span class="badge rounded-pill text-bg-success">{{ucfirst($mantenimientosItem->estado_mantenimiento);}}</span></td>@endif
              <!--INICIO DE BOTONES DE ACCIONES-->
              <td class="td_acciones">
              <div class="btn-group">
                @if($mantenimientosItem->estado_mantenimiento == "en proceso")
                <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO RESUELTO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como completado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                    <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
                  </svg></a>
                 <!--FIN ACTUALIZAR ESTADOA A MARCAR COMO RESUELTO -->
                  @elseif ($mantenimientosItem->estado_mantenimiento == "solicitado")
                 <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como en proceso"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                  </svg></a>
                 <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO -->
                  @else
                 <!--BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO-->
                    <a type="button" href="{{route('mantenimientos.actualizarEstado', $mantenimientosItem)}}" class="btn btn-outline-success" title="Marcar como solicitado"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                  </svg></a>
                 <!--FIN BOTON ACTUALIZAR ESTADO A MARCAR COMO EN PROCESO -->
                 @endif
                 <!--BOTON EDITAR MANTENIMIENTO-->
                    <a type="button" href="{{route('mantenimientos.edit', $mantenimientosItem)}}" class="btn btn-outline-info" title="Editar solicitud"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                 <!--FIN EDITAR MANTENIMIENTO -->
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
          {{$mantenimientos->links('pagination::bootstrap-4')}}
      <!--SCRIPT DATATABLE-->
        <script src="{{url('js/main.js')}}"></script>
      <!--FIN DE SCRIPT DATATABLE-->  
        <br><br>
      </div>  
      </div>  
@endsection('content')