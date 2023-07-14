@extends('layouts.layout_panel')
<title>Ingresar pago - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1><strong>INGRESAR PAGO</h1></strong></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('pagos.update', $valoresPagarItem)}}" method="POST">
         	@csrf @method('PATCH')
           <div class="col-auto">
            <label>Numero de medidor:</label><center><input type="text" class="form-control mb-3" name="numero_medidor" value="{{$valoresPagarItem->numero_medidor}}" placeholder="{{$valoresPagarItem->numero_medidor}}" disabled></input></center>

            <label>Cédula:</label><center><input type="text" class="form-control mb-3" name="cedula" value="{{$valoresPagarItem->cedula}}" placeholder="{{$valoresPagarItem->cedula}}" disabled></input></center>

            <label>Nombre del cliente:</label><center><input type="text" class="form-control mb-3" name="nombre" value="{{$valoresPagarItem->nombre}}" placeholder="{{$valoresPagarItem->nombre}}" disabled></input></center>

            <label>Apellido del cliente:</label><center><input type="text" class="form-control mb-3" name="apellido" value="{{$valoresPagarItem->apellido}}" placeholder="{{$valoresPagarItem->apellido}}" disabled></input></center>

            <label>Valor actual:</label><div class="input-group mb-3"><span class="input-group-text">$</span><center><input type="text" class="form-control" name="valor_actual" value="{{$valoresPagarItem->valor_actual}}" placeholder="{{$valoresPagarItem->valor_actual}}" disabled></input></center></div>

            <label>Meses en mora:</label><center><input type="text" class="form-control mb-3" name="meses_mora" value="{{$valoresPagarItem->meses_mora}}" placeholder="{{$valoresPagarItem->meses_mora}}" required></input></center>
            <label>Ultimo pago realizado:</label><div class="input-group mb-3"><span class="input-group-text">$</span><center><input type="text" class="form-control"  value="{{$valoresPagarItem->valor_pagado}}" placeholder="{{$valoresPagarItem->valor_pagado}}" disabled></input></center></div>

            <label>Valor restante:</label><div class="input-group mb-3"><span class="input-group-text">$</span><center><input type="text" class="form-control" name="valor_restante" value="{{$valoresPagarItem->valor_restante}}" placeholder="{{$valoresPagarItem->valor_restante}}" disabled></input></center></div>

            <!--INICIO DE VALOR A PAGAR-->
              <label>Valor a pagar:</label><div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control" name="valor_nuevo" placeholder="Ingrese el valor a pagar" aria-label="Monto" required>
              </div>
            <!--FIN DE VALOR A PAGAR-->

          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Registrar Pago</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')