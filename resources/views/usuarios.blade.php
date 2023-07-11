@if(isset(session()->get('sesion')['usuario']) && session()->get('sesion')['rol'] != 'administrador')
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_panel')
<title>Gestión de Usuarios | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
   <style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (USUARIOS)*/
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

<center><h1><strong>GESTIÓN DE USUARIOS</h1></strong></center>
    <div class="container">
      <br>
        <div class="col-md-12 bg-light text-right"><a href="crear-usuario" type="submit" class="btn btn-success float-end">Nuevo Usuario</a></div>
        <br><br>
         <form>
           <div class="col-auto">
     		 <center><input type="text" class="form-control" placeholder="Nombre de Usuario"></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-primary">Consultar</button></center></div>
          <br>
        </form>
        </div>
        <!--INICIO DE TABLA CON VALORES-->
        <!--FIN DE TABLA CON VALORES-->
    </div>

@endsection('content')

@endif