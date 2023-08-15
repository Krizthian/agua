@extends('layouts.layout_home')
<title>Calculadora de valores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">

@section('content')
<style>
  /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (PAGINA DE INICIO)*/
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
    .image-container {
      width: 900px; 
      height: 318px;
    }
</style>

<center><h1 class="display-4">CALCULADORA DE VALORES</h1></center>
<br>
<div class="container">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
               <main class="form-signin w-100 m-auto">
        <h5 class="display-8">CALCULADORA</h5>
              <hr>
                   <form action="{{route('calculadora.calcular')}}" method="POST">
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
                      <label>Categoría:</label>
                      <select class="form-select mb-2" id="tipo" name="tipo" required>
                          <option value="residencial" selected>Residencial</option>
                      </select>
                      <label>Metros Cúbicos (m<sup>3</sup>):</label><center><input type="text" placeholder="Ingresa la lectura de tu medidor" class="form-control mb-2 @error('valor') is-invalid @enderror " name="valor" value="{{old('valor')}}" required></input></center>
                    @if(session('valor_actual'))
                      <hr>
                      <label>Costo del agua:</label><input type="text" class="form-control mb-2" value="$ {{ session('costo_agua') }}" readonly></input></center>
                      <label>Mantenimiento:</label><input type="text" class="form-control mb-2" value="$ 0.00" readonly></input></center>
                      <label>Valor aproximado a pagar:</label><input type="text" class="form-control mb-2" value="$ {{ session('valor_actual') }}" readonly></input></center>
                    @endif  
                      <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Calcular</button></center></div>
                      <br>
                  </form>
              </main>
        </div>
        <div class="col-lg-6 ">
          <div class="table-responsive mt-3">
              <h5 class="display-8">TARIFARIO</h5>
              <hr>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Rango</th>
                      <th scope="col">Costo por m³</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tarifas as $tarifa)
                    <tr>
                      <td class="text-center">0 - 15 m³</td>
                      <td class="text-center" class="text-center">$ {{$tarifa->tarifa_a}}</td>
                    </tr>
                    <tr>
                      <td class="text-center">16 - 30 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_b}}</td>
                    </tr>
                    <tr>
                      <td class="text-center">31 - 60 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_c}}</td>
                    </tr>
                    <tr>
                      <td class="text-center">61 - 100 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_d}}</td>
                    </tr>
                    <tr>
                      <td class="text-center">101 - 300 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_e}}</td>
                    </tr>
                    <tr>
                      <td class="text-center">301 - 2500 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_f}}</td>
                    </tr> 
                    <tr>
                      <td class="text-center">2501 - 5000 m³</td>
                      <td class="text-center">$ {{$tarifa->tarifa_g}}</td>
                    </tr>
                   <tr>
                      <td class="text-center">5000 m³ en adelante</td>
                      <td class="text-center">$ {{$tarifa->tarifa_h}}</td>
                    </tr> 
                    @endforeach   
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
</div>
@endsection('content')
