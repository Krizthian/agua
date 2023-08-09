<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recuperación de Contraseña</title>
</head>
<body>
	<p>Estimado usuario del <b>Sistema de Consultas de Valores a Pagar del Agua de Portovelo</b></p>
	<p>Se ha solicitado un enlace para recuperar la contraseña, por favor, haz clic en el siguiente enlace para actualizar tu contraseña:</p>
	<a href="{{ route('validarToken', ['token' => $token, 'id' => $id_usuarioRecuperar]) }}">Recuperar Contraseña</a>
	<br>
	<br>
	<strong>Nota: </strong>Este enlace expirará en 2 horas
</body>
</html>
