@extends('layouts.layout_panel')
<title>Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
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

<center><h1 class="display-4">GESTIÓN DE MEDIDORES</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE HISTORIAL DE PAGOS-->
            <div class="col-md-12 text-right"><a title="Mantenimientos" href="#" type="submit" class="btn btn-dark float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE HISTORIAL DE PAGOS-->
        <div class="col-md-12 bg-light text-right"><a href="{{route('medidores.create')}}" type="submit" class="btn btn-success float-end">Nuevo Medidor</a></div>
        <br><br>
         <form action="{{route('medidores.busqueda')}}" method="GET">
           <div class="col-auto">
            <center><input type="text" class="form-control" name="valores" placeholder="Numero de medidor" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO-->
          @if(session('resultado_ingreso'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha ingresado el consumo correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
        <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO CON PLANILLA-->
          @if(session('resultado_ingresoPlanilla'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha ingresado el <strong>consumo</strong> correctamente y se ha creado una nueva <strong>planilla</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
        <!--INICIO DE MENSAJE DE RESULTADO DE CREACION-->
          @if(session('resultado_creacion'))
            <div class="alert alert-success alert-dismissible fade show">
                Se ha creado el medidor correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          @endif  
        <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
        </div>

        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"># Medidor</th>
              <th scope="col">Propietario</th>
              <th scope="col">Fecha de Instalación</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Consumo</th>
              <th scope="col">Responsable de lectura</th>
              <th scope="col">Fecha de lectura</th>
              <th scope="col" align="center">Acciones</th> 
            </tr>
          </thead>
          <tbody>
        @if(count($consumoMedidor)<=0)
              <center><tr><td colspan="8">No se han encontrado resultados</td></tr></center>
        @else
         @foreach ($consumoMedidor as $consumoMedidorItem)   
            <tr>
              <td class="td_acciones">{{$consumoMedidorItem->numero_medidor}}</td>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="{{route('clientes.listar', $consumoMedidorItem->cliente )}}">{{$consumoMedidorItem->cliente->nombre}} {{$consumoMedidorItem->cliente->apellido}}</a></td>
              <td class="td_acciones">{{$consumoMedidorItem->fecha_instalacion}}</td>
              <td class="td_acciones">{{$consumoMedidorItem->ubicacion}}</td>
              @isset($consumoMedidorItem->consumo)
              <td class="td_acciones">{{$consumoMedidorItem->consumo->consumo_actual}} m<sup><strong>3</strong></sup></td>
              <td class="td_acciones">{{$consumoMedidorItem->consumo->responsable}}</td>
              <td class="td_acciones">{{$consumoMedidorItem->consumo->fecha_lectura_actual}}</td>
              @else
               <td class="td_acciones text-muted">N/D</td>
               <td class="td_acciones text-muted">N/D</td>
               <td class="td_acciones text-muted">N/D</td>
              @endisset
              <!--INICIO DE BOTONES DE ACCIONES-->
              <td class="td_acciones">
              <div class="btn-group">
                <!--BOTON INGRESAR CONSUMO-->
                    <a type="button" href="{{route('consumos.ingresarConsumo', $consumoMedidorItem)}}" class="btn btn-outline-success" title="Ingresar consumo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-droplet" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z"/>
                    <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z"/>
                  </svg></a>
                 <!--FIN INGRESAR CONSUMO -->
                  <!--BOTON SOLICITAR MANTENIMIENTO-->
                    <a type="button" href="#" class="btn btn-outline-dark" title="Solicitar mantenimiento"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                    <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                    <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                  </svg></a>
                 <!--FIN SOLICITAR MANTENIMIENTO -->
                 <!--BOTON EDITAR MEDIDOR-->
                    <a type="button" href="{{route('medidores.edit', $consumoMedidorItem )}}" class="btn btn-outline-info" title="Editar medidor"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg></a>
                 <!--FIN EDITAR MEDIDOR -->
              </div>   
              </td>
              <!--FIN DE BOTONES DE ACCIONES-->
            </tr>
         @endforeach 
         @endif  
              </td>
            </tr> 
          </tbody>
        </table>
        {{$consumoMedidor->links('pagination::bootstrap-4')}}
      </div>        
        <!--FIN DE TABLA CON VALORES-->
        <!--BOTON DE IMPRIMIR-->
          <div class="col-md-12 bg-light text-right"><button title="Imprimir" class="btn btn-info float-end" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
          </svg></button></div>
        <!--FIN DE BOTON DE IMPRIMIR-->
        <br><br>
    </div>

@endsection('content')