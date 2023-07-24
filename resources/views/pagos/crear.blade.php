@extends('layouts.layout_panel')
<title>Crear planilla - Gestión de Pagos | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1><strong>CREAR PLANILLA</h1></strong></center>
    <div class="container">
      <br>

        <main class="form-signin w-100 m-auto">
         <form action="{{route('pagos.store')}}" method="POST">
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
        <label>Medidor asociado:</label>
        <div class="form-group ">
          <select class="form-select input-group mb-3 @error('numero_medidor') is-invalid @enderror" id="numero_medidor" name="numero_medidor" required>
            <option value="Seleccione un medidor" required selected disabled>Seleccione un medidor</option>
            @foreach ($queryMedidores as $queryMedidoresItem)
            <option value="{{$queryMedidoresItem->numero_medidor}}" required>{{$queryMedidoresItem->numero_medidor}} - {{$queryMedidoresItem->nombre}} {{$queryMedidoresItem->apellido}}</option>
            @endforeach
          </select>
            <label>Meses en mora:</label><center><input type="text" class="form-control mb-3 @error('meses_mora') is-invalid @enderror" name="meses_mora" value="{{old('meses_mora')}}" placeholder="Ingrese la cantidad de meses en mora" required></input></center>

              <label>Valor actual:</label><div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control @error('valor_actual') is-invalid @enderror" name="valor_actual" value="{{old('valor_actual')}}" placeholder="Ingrese el valor actual a pagar" aria-label="Monto" required>
              </div>

        </div>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar Planilla</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')