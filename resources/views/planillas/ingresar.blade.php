@extends('layouts.layout_panel')
<title>Ingresar pago - Gestión de Pagos | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">INGRESAR PAGO</h1></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('planillas.update', $valoresPagarItem)}}" method="POST">
         	@csrf @method('PATCH')
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
            <label>Numero de medidor:</label><center><input type="text" class="form-control mb-2" name="numero_medidor" value="{{$valoresPagarItem->medidor->numero_medidor}}" placeholder="{{$valoresPagarItem->medidor->numero_medidor}}" disabled></input></center>

            <label>Cédula:</label><center><input type="text" class="form-control mb-2" name="cedula" value="{{$valoresPagarItem->cliente->cedula}}" placeholder="{{$valoresPagarItem->cliente->cedula}}" disabled></input></center>

            <label>Nombre del cliente:</label><center><input type="text" class="form-control mb-2" name="nombre" value="{{$valoresPagarItem->cliente->nombre}}" placeholder="{{$valoresPagarItem->cliente->nombre}}" disabled></input></center>

            <label>Apellido del cliente:</label><center><input type="text" class="form-control mb-2" name="apellido" value="{{$valoresPagarItem->cliente->apellido}}" placeholder="{{$valoresPagarItem->cliente->apellido}}" disabled></input></center>

            <label>Valor actual:</label><div class="input-group mb-2"><span class="input-group-text">$</span><center><input type="text" class="form-control" name="valor_actual" value="{{$valoresPagarItem->valor_actual}}" placeholder="{{$valoresPagarItem->valor_actual}}" disabled></input></center></div>

            <label>Consumo actual (m<sup><strong>3</strong></sup>):</label><center><input type="text" class="form-control mb-2"  value="{{$valoresPagarItem->consumo->consumo_actual}}" placeholder="{{$valoresPagarItem->consumo->consumo_actual}}" disabled></input></center></div>

            <label>Fecha de factura:</label><center><input type="text" class="form-control mb-2"  value="{{$valoresPagarItem->fecha_factura}}" placeholder="{{$valoresPagarItem->fecha_factura}}" disabled></input></center>

            <label>Forma de pago:</label><center><select class="form-select input-group mb-3 @error('forma_pago') is-invalid @enderror" id="forma_pago" name="forma_pago">
              <option value="Seleccione una forma de pago" required selected disabled>Seleccione una forma de pago</option>
              <option value="efectivo">Efectivo</option>
              <option value="cheque">Cheque</option>
              <option value="otro">Otro</option>
            </select></center>

            <!--INICIO DE VALOR A PAGAR-->
              <label>Valor a pagar:</label><div class="input-group mb-2">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control @error('valor_nuevo') is-invalid @enderror" name="valor_nuevo" value="{{old('valor_nuevo')}}" placeholder="Ingrese el valor a pagar" aria-label="Monto" required>
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