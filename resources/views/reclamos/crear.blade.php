@extends('layouts.layout_home')
<title>Ingresar reclamo | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">INGRESAR RECLAMO</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('consulta.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->      
        <main class="form-signin w-100 m-auto">
         <form action="{{route('reclamos.store', $pagosConsultaItem)}}" method="POST">
         	@csrf
          <!--DEVOLVEMOS MENSAJES DE ERROR-->
              @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error de validación</strong><br>
                        <ul>
                          @foreach ($errors->all() as $error)          
                              <li>{{ $error }}</li>
                             @endforeach   
                        </ul>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>       
                  </div>
              @endif
          <!--FIN DE MENSAJES DE ERROR-->
           <div class="col-auto">
            <label>Nombre del cliente:</label><center><input type="text" class="form-control mb-2" name="nombre" value="{{$pagosConsultaItem->cliente->nombre}}"></input></center required>

            <label>Apellido del cliente:</label><center><input type="text" class="form-control mb-2" name="apellido" value="{{$pagosConsultaItem->cliente->apellido}}"></input required></center>

            <label>Número de medidor:</label><center><input type="text" class="form-control mb-2" name="numero_medidor" value="{{$pagosConsultaItem->medidor->numero_medidor}}" required></input></center>

            <label>Número de planilla:</label><center><input type="text" class="form-control mb-2" name="numero_planilla" value="{{$pagosConsultaItem->id}}" required></input></center>

            <label>Email:</label><center><input type="text" class="form-control mb-2" name="email" placeholder="Ej. jose@gmail.com" required></input></center>

            <label>Teléfono:</label><center><input type="text" class="form-control mb-2" name="telefono" value="{{$pagosConsultaItem->cliente->telefono}}" required></input></center>

            <label>Motivo de reclamo:</label><center><textarea maxlength="255" type="text" class="form-control mb-2" name="motivo" placeholder="Ingrese el motivo del reclamo" required></textarea></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Registrar Reclamo</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')