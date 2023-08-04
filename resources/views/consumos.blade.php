@extends('layouts.layout_panel')
<title>Gestión de Consumos | Sistema de Consultas de Valores a Pagar del Agua</title>
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

<center><h1 class="display-4">GESTIÓN DE CONSUMOS</h1></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="{{route('clientes.create')}}" type="submit" class="btn btn-success float-end">Registrar Consumo</a></div>
        <br><br>
         <form action="{{route('clientes.busqueda')}}" method="GET">
           <div class="col-auto">
            <center><input type="text" class="form-control" name="valores" placeholder="Numero de medidor"></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        </div>

        <!--INICIO DE TABLA CON VALORES-->
       <div class="table-responsive"> 
        <table class="table-hover table-responsive table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Numero de Medidor</th>
              <th scope="col">Fecha de Instalación</th>
              <th scope="col">Ubicación</th>
              <th scope="col" align="center">Acciones</th> 
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td_acciones"><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="#"></a></td>
              <td class="td_acciones"></td>
              <td class="td_acciones"></td>
              <td class="td_acciones"></td>
              <td class="td_acciones">
              </td>
            </tr>
              </td>
            </tr> 
          </tbody>
        </table>
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