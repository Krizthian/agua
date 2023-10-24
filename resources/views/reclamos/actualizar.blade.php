@extends('layouts.layout_panel')
<title>Actualizar Estado de Reclamo - Gestión de Reclamos | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">ACTUALIZAR ESTADO DE RECLAMO</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('reclamos.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->
        <main class="form-signin w-100 m-auto">
         <form action="{{route('reclamos.update', $reclamosItem)}}" method="POST">
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
            <label>Cliente:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
                  <input type="text" value="{{$reclamosItem->nombre}} {{$reclamosItem->apellido}}" name="nombre" class="form-control" disabled></input>
              </div>
            </div>

           <div class="col-auto">
            <label>Número de medidor:</label>
             <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>             
                <input type="text" value="{{$reclamosItem->numero_medidor}}" class="form-control" disabled></input>
            </div>
          </div>

           <div class="col-auto">
            <label>Número de planilla:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-file-invoice fa-sm"></i></span>
                <input type="text" class="form-control" name="numero_planilla" value="{{$reclamosItem->numero_planilla}}" disabled></input>
            </div>
          </div>

           <div class="col-auto">
            <label>Email:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-envelope fa-sm"></i></span>
                <input type="text" class="form-control" value="{{$reclamosItem->email}}" disabled></input>
            </div>
          </div>

           <div class="col-auto">
            <label>Teléfono:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-phone fa-sm"></i></span>
                <input type="text" value="{{$reclamosItem->telefono}}" class="form-control" disabled></input>
          </div>
        </div>
           <div class="col-auto">
            <label>Motivo de reclamo:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-circle-info"></i></span>
              <textarea maxlength="255" rows="3" type="text" class="form-control" placeholder="{{$reclamosItem->motivo}}" disabled></textarea>
          </div>
        </div>
        <hr>
           <div class="col-auto">
            <label>Estado del reclamo:</label>
              <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fa-solid fa-clock fa-sm"></i></span>
                      <select class="form-select input-group" id="estado_reclamo" name="estado_reclamo" required>
                          @if($reclamosItem->estado_reclamo == "ingresado")
                            <option value="en proceso" required selected>En proceso</option>
                          @endif
                          @if($reclamosItem->estado_reclamo == "en proceso")
                            <option value="resuelto" required selected>Resuelto</option>
                          @endif
                          @if($reclamosItem->estado_reclamo == "resuelto")
                            <option value="ingresado" required selected>Ingresado</option>
                          @endif
                          <option value="ingresado" required>Ingresado</option>
                          <option value="en proceso" required>En proceso</option>
                          <option value="resuelto" required>Resuelto</option>
                      </select>
                    </div>
                  </div>
           <div class="col-auto">
            <label>Observación:</label>
              <div class="input-group mb-2">
               <span class="input-group-text"><i class="fa-solid fa-comment fa-sm"></i></span>
              <textarea maxlength="255" rows="3" type="text" name="observacion" placeholder="Ingrese una observacion" class="form-control">{{$reclamosItem->observacion}}</textarea>
          </div>
        </div>
         <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')