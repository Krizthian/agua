<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Planilla de Agua - Medidor {{$mensaje['numero_medidor']}} GAD MUNICIPAL DE PORTOVELO</title>
</head>
<body>
	<center><img class="img-fluid" src="https://i.imgur.com/DefRoeB.png" width="300" height="100" alt="GAD DE PORTOVELO logo"></center>
	<p><strong>Estimado(a)</strong>,</p>
	{{$mensaje['apellido_cliente']}}, {{$mensaje['nombre_cliente']}}<br>
	<p><strong>Cédula/RUC: </strong>{{$mensaje['cedula_cliente']}}</p>
	<p>Le saludamos desde el GAD Municipal de Portovelo, notificándole que su planilla asociada al medidor <strong>{{$mensaje['numero_medidor']}}</strong> ha sido generada en la fecha <strong>{{$mensaje['fecha_factura']}}</strong> con un valor a pagar de <strong>$ {{number_format($mensaje['valor_actual'], 2)}}</strong> con una fecha máxima de pago hasta el <strong>{{$mensaje['fecha_maxima']}}</strong> </p>
	<p>Por favor, acérquese a realizar el pago antes de la fecha máxima para evitar cortes del servicio</p>
	<p>Adicionalmente, puede revisar más a detalle los valores de su planilla, así como también los consumos asociados a la misma a través del siguiente enlace: </p>
	<p><a href="{{ route('consulta.index')}}">Consultar mis valores a pagar</a></p>
	<p><strong>Nota: </strong> Le notificamos que el mensaje recibido ha sido generado automáticamente por nuestro sistema, por favor no lo responda, en caso de tener dudas, comuníquese con el Municipio de Portovelo llamando al número <strong>(07)2949-197</strong>, o acérquese a nuestras oficinas.</p>
	<p>Saludos</p>
	<p>Atentamente,</p>
	<p>Departamento de recaudación del GAD Municipal de Portovelo.</p>
</body>
</html>