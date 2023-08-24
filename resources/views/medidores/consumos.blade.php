@extends('layouts.layout_panel')
<title>Ingresar Consumo - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>
    <center><h1 class="display-4">INGRESAR CONSUMO</h1></center>
    <div class="container">
      <br>
	      <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
		  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
		</svg></a></div>
    <br>
        <main class="form-signin w-100 m-auto">
         <form id="formConsumo" action="{{route('consumos.almacenarConsumo', $consumoMedidorItem)}}" method="POST">
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
            <label>Número de medidor:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>            
              <input type="text" class="form-control" name="numero_medidor" value="{{$consumoMedidorItem->numero_medidor}}" placeholder="{{$consumoMedidorItem->numero_medidor}}" disabled></input>
            </div>
          </div>

          <div class="col-auto">
            <label>Ubicación de medidor:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span>  
                <input type="text" class="form-control" name="ubicacion" value="{{$consumoMedidorItem->ubicacion}}" placeholder="{{$consumoMedidorItem->ubicacion}}" disabled></input>
            </div>
          </div>

            <div class="col-auto">
              <label>Consumo anterior (m<sup><strong>3</strong></sup>):</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span> 
              <input type="text" class="form-control" name="consumo_anterior" 
              @isset($consumoMedidorItem->consumo->consumo_actual) value="{{$consumoMedidorItem->consumo->consumo_actual}}" placeholder="{{$consumoMedidorItem->consumo_actual}}" @else value="0" placeholder="0" @endisset readonly></input>
              </div>
            </div>

          <div class="col-auto">
            <label>Fecha de lectura anterior:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span>       
              <input type="text" class="form-control" name="fecha_lectura_anterior" @isset($consumoMedidorItem->consumo->fecha_lectura_actual) value="{{$consumoMedidorItem->consumo->fecha_lectura_actual}}" placeholder="{{$consumoMedidorItem->fecha_lectura_actual}}" @else value="2000-08-05" placeholder="2000-08-05" @endisset readonly></input>
            </div>
          </div>
            <hr>
            <div class="col-auto">
              <label>Consumo actual (m<sup><strong>3</strong></sup>):</label>
               <div class="input-group mb-2">
               <span class="input-group-text"><i class="fa-solid fa-droplet fa-sm"></i></span>  
                  <input type="text" class="form-control @error('consumo_actual') is-invalid @enderror" name="consumo_actual" placeholder="Ingrese el consumo actual" required></input>
              </div>
            </div>

            <div class="col-auto">
            <label>Responsable de lectura:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user-pen fa-sm"></i></span>
                <input type="text" class="form-control @error('responsable') is-invalid @enderror" name="responsable" value="{{session()->get('sesion')['nombres']}}" readonly required></input>
                </div>  
              </div> 
          <br>
              <div class="col-md-12 text-right">
                  <center>
                    <button id="ingresar" type="button" class="btn btn-success">Ingresar Consumo</button>
                  </center>
              </div>    
              <script>
                  $(document).ready(function() {
                      $('#ingresar').click(function() {
                          // Mostrar el mensaje de confirmación con SweetAlert
                          Swal.fire({
                              title: 'Confirmación',
                              text: '¿Estás seguro de que deseas ingresar un consumo a este medidor?',
                              icon: 'info',
                              showCancelButton: true,
                              confirmButtonText: 'Sí, ingresar consumo',
                              cancelButtonText: 'Cancelar'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  $('#formConsumo').submit();
                              }
                          });
                      });
                  });
              </script>
          <br>            
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')
