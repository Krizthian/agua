@extends('layouts.layout_panel')
<title>Actualizar Planilla - Gestión de Pagos | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
       
    </style>

<center><h1><strong>ACTUALIZAR PLANILLA</h1></strong></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('planillas.bill', $valoresPagarItem)}}" method="POST">
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
            <label>Numero de medidor asociado:</label><center><input type="text" class="form-control mb-2" name="numero_medidor" value="{{$valoresPagarItem->numero_medidor}}" placeholder="{{$valoresPagarItem->numero_medidor}}" disabled></input></center>

            <label>Cédula:</label><center><input type="text" class="form-control mb-2" name="cedula" value="{{$valoresPagarItem->cedula}}" placeholder="{{$valoresPagarItem->cedula}}" ></input></center>

            <label>Nombre del cliente:</label><center><input type="text" class="form-control mb-2" name="nombre" value="{{$valoresPagarItem->nombre}}" placeholder="{{$valoresPagarItem->nombre}}" ></input></center>

            <label>Apellido del cliente:</label><center><input type="text" class="form-control mb-2" name="apellido" value="{{$valoresPagarItem->apellido}}" placeholder="{{$valoresPagarItem->apellido}}"></input></center>

            <label>Valor a pagar:</label><div class="input-group mb-2"><span class="input-group-text">$</span><center><input type="text" class="form-control" name="valor_pagar" value="{{$valoresPagarItem->valor_actual}}" placeholder="{{$valoresPagarItem->valor_actual}}" ></input></center></div>

            <label>Fecha de facturación:</label><div class="input-group mb-2"><center><input type="date" class="form-control" name="fecha_factura" value="{{$valoresPagarItem->fecha_factura}}" /></center></div>

            <label>Fecha maxima de pago:</label><div class="input-group mb-2"><center><input type="date" class="form-control" name="fecha_maxima" value="{{$valoresPagarItem->fecha_maxima}}" /></center></div>

            <label>Meses en mora:</label><center><input type="text" class="form-control mb-2 @error('meses_mora') is-invalid @enderror" name="meses_mora" value="{{old('meses_mora',$valoresPagarItem->meses_mora)}}" placeholder="{{$valoresPagarItem->meses_mora}}" required></input></center>

          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')