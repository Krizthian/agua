@extends('layout_home')

@section('content')
<div class="container">
      <form>
    <br>
    <br>
       <div class="col-auto">
      <center><input type="text" class="form-control" placeholder="Número de medidor o cédula"></input></center>
      <br>
      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
      <br>
</div>

    </form>
</div>

@endsection('content')