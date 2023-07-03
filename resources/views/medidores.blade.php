@extends('layouts.layout_panel')

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

<center><h1><strong>GESTIÓN DE MEDIDORES</h1></strong></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="crear-medidor" type="submit" class="btn btn-success float-end">Nuevo Medidor</a></div>
        <br><br>
         <form>
           <div class="col-auto">
            <center><input type="text" class="form-control" placeholder="Nombres, número de medidor o cédula"></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        </div>
        <!--INICIO DE TABLA CON VALORES-->
        <!--FIN DE TABLA CON VALORES-->
    </div>

@endsection('content')