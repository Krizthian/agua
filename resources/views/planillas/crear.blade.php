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

<center><h1 class="display-4">CREAR PLANILLA</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('panel.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
        <!--FIN DE BOTON DE REGRESAR-->      
        <main class="form-signin w-100 m-auto">
         <form action="{{route('planillas.store')}}" method="POST">
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
        <div class="form-group">
          <select class="form-select input-group mb-3 @error('numero_medidor') is-invalid @enderror" id="numero_medidor" name="numero_medidor" required>
              <option value="Seleccione un medidor" required selected disabled>Seleccione un medidor</option>
              @foreach ($queryMedidores as $medidor)
                  <option value="{{ $medidor->numero_medidor }}" required>
                      {{ $medidor->numero_medidor }} - {{ $medidor->cliente->nombre }} {{ $medidor->cliente->apellido }}
                  </option>
              @endforeach
          </select>
          <label>Fecha de factura:</label><div class="input-group mb-3">
            <center><input type="date" class="form-control @error('fecha_factura') is-invalid @enderror" name="fecha_factura" value=""></center></div>
          <label>Fecha maxima de pago:</label><div class="input-group mb-3" required>
            <center><input type="date" class="form-control @error('fecha_maxima') is-invalid @enderror" name="fecha_maxima" value=""/></center></div>
          <label>Valor actual:</label><div class="input-group mb-3" required>
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