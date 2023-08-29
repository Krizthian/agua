<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Notificación de valores pendientes - Medidor {{$mensaje['cliente_medidor']}} GAD MUNICIPAL DE PORTOVELO</title>
</head>
<body>
	<center><img class="img-fluid" src="https://i.imgur.com/DefRoeB.png" width="300" height="100" alt="GAD DE PORTOVELO logo"></center>
	<p><strong>Estimado(a)</strong>,</p>
	{{$mensaje['cliente_apellido']}}, {{$mensaje['cliente_nombre']}}<br>
	<p><strong>Cédula/RUC: </strong>{{$mensaje['cliente_cedula']}}</p>
	<p>El presente mensaje es una notificación de parte del departamento de cobros de agua de la institución, hemos identificado que cuenta con valores pendientes asociados a su medidor <strong>{{$mensaje['cliente_medidor']}}</strong> de <strong>${{$mensaje['cliente_planilla_valorActual']}}</strong> correspondientes a la factura generada el <strong>{{$mensaje['cliente_planilla_fechaFactura']}}</strong>, solicitamos que se acerque a realizar el pago de su planilla <strong>(#{{$mensaje['cliente_planilla_id']}})</strong></p>

	<p>Puede revisar mas a detalle los valores de su planilla así como también los consumos asociados a la misma a través del siguiente enlace: </p>
	<p><a href="{{ route('home')}}">Consultar mis valores a pagar</a></p>
	<p><strong>Nota: </strong> Le notificamos que el mensaje recibido <strong>NO</strong> ha sido generado automáticamente por nuestro sistema, hemos determinado que usted presenta una deuda que requiere ser urgentemente liquidada, por lo que debe considerar que estamos evaluando muy de cerca su caso y su historial de pagos para la toma de futuras decisiones en caso de continuar sin realizar el pago de su servicio de agua.</p>
	<p>Saludos</p>
	<p>Atentamente,</p>
	<p>Departamento de recaudación del GAD Municipal de Portovelo</p>
</body>
</html>