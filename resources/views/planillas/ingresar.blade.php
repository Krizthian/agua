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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const valorActualInput = document.querySelector('input[name="valor_actual"]');
            const valorNuevoInput = document.querySelector('input[name="valor_nuevo"]');
            const rellenarButton = document.getElementById('rellenarValor');
            
            rellenarButton.addEventListener('click', function() {
                valorNuevoInput.value = valorActualInput.value;
            });
        });
    </script>
<center><h1 class="display-4">INGRESAR PAGO</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('panel.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div><br><br>
      <!--FIN DE BOTON DE REGRESAR-->      
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
        <main class="w-100 m-auto">
         <form action="{{route('planillas.update', $valoresPagarItem)}}" method="POST" id="formPago" class="row g3">
         	@csrf @method('PATCH')
          <div class="col-md-6 mb-2">
            <label for="numero_medidor">Número de medidor:</label><center><input type="text" class="form-control mb-2" id="numero_medidor" name="numero_medidor" value="{{$valoresPagarItem->medidor->numero_medidor}}" placeholder="{{$valoresPagarItem->medidor->numero_medidor}}" disabled></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label for="cedula">Cédula:</label><center><input type="text" id="cedula" class="form-control mb-2" name="cedula" value="{{$valoresPagarItem->cliente->cedula}}" placeholder="{{$valoresPagarItem->cliente->cedula}}" disabled></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label for="nombre">Nombre del cliente:</label><center><input type="text" id="nombre" class="form-control mb-2" name="nombre" value="{{$valoresPagarItem->cliente->nombre}}" placeholder="{{$valoresPagarItem->cliente->nombre}}" disabled></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label for="apellido">Apellido del cliente:</label><center><input id="apellido" type="text" class="form-control mb-2" name="apellido" value="{{$valoresPagarItem->cliente->apellido}}" placeholder="{{$valoresPagarItem->cliente->apellido}}" disabled></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label for="consumo_actual">Consumo actual (m<sup><strong>3</strong></sup>):</label><center><input type="text" id="consumo_actual" class="form-control mb-2"  value="{{$valoresPagarItem->consumo->consumo_actual}}" placeholder="{{$valoresPagarItem->consumo->consumo_actual}}" disabled></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label for="valor_actual">Valor actual:</label><div class="input-group mb-2"><span class="input-group-text"><strong>$</strong></span><center><input type="text" class="form-control" id="valor_actual" name="valor_actual" value="{{$valoresPagarItem->valor_actual}}" placeholder="{{$valoresPagarItem->valor_actual}}" disabled></input></center></div>
          </div>
          <div class="col-md-6 mb-2">
            <label for="fecha_factura">Fecha de factura:</label><center><input id="fecha_factura" type="text" class="form-control mb-2"  value="{{$valoresPagarItem->fecha_factura}}" placeholder="{{$valoresPagarItem->fecha_factura}}" disabled></input></center>
           </div> 
           <div class="col-md-6 mb-2"> 
            <label for="forma_pago">Forma de pago:</label><center><select class="form-select input-group mb-3 @error('forma_pago') is-invalid @enderror" id="forma_pago" name="forma_pago">
              <option value="Seleccione una forma de pago" required selected disabled>Seleccione una forma de pago</option>
              <option value="efectivo">Efectivo</option>
              <option value="cheque">Cheque</option>
              <option value="otro">Otro</option>
            </select></center>
          </div>
          <div class="col-md-12 mb-2"> 
            <!--INICIO DE VALOR A PAGAR-->
              <label for="valor_nuevo">Valor a pagar:</label><div class="input-group mb-2">
                <button type="button" title="Rellenar con valor a pagar" class="btn btn-info" id="rellenarValor"><i class="fa-solid fa-file-invoice-dollar"></i></button>
                <span class="input-group-text">$</span>
                <input type="text" id="valor_nuevo" class="form-control @error('valor_nuevo') is-invalid @enderror" name="valor_nuevo" value="{{old('valor_nuevo')}}" placeholder="Ingrese el valor a pagar" aria-label="Monto" required>
              </div>
            <!--FIN DE VALOR A PAGAR-->
          <br>
              <div class="col-md-12 text-right">
                  <center>
                      <button id="pagar" type="button" class="btn btn-success">Registrar Pago</button>
                  </center>
              </div>
              <script>
                  $(document).ready(function() {
                      $('#pagar').click(function() {
                          // Mostrar el mensaje de confirmación con SweetAlert
                          Swal.fire({
                              title: 'Confirmación',
                              text: '¿Estás seguro de que deseas ingresar un pago al medidor {{$valoresPagarItem->medidor->numero_medidor}}?',
                              icon: 'question',
                              showCancelButton: true,
                              confirmButtonText: 'Sí, registrar pago',
                              cancelButtonText: 'Cancelar'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  $('#formPago').submit();
                              }
                          });
                      });
                  });
              </script>
          <br>
        </form>
    </main>
        <br><br>
    </div>

@endsection('content')