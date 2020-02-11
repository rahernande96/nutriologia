<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Confirmación de pago</title>
	<style>
	/* Style the body */
	body {
	font-family: Arial;
	margin: 0;
	}

	/* Header/Logo Title */
	.header {
	padding: 40px;
	text-align: center;
	background: #1abc9c;
	color: white;
	font-size: 30px;
	}

	/* Page Content */
	
	h1,p{
		text-align: center;
	}
	.button{
		text-decoration: none;
		background-color: cadetblue;
		padding: 15px 15px;
		color: #fff;
		border-radius: 5px;
	}
	.container-button{
		margin-top: 50px;
		margin-bottom: 50px;
	}
	</style>
</head>
<body>
		{{-- {{ $data->name }} --}}
	<div class="header">
		<h1>Nutriología</h1>
		<p>Bienvenid@ {{ $data->name }}</p>
	</div>
	<div class="content">
		<h1>Confirmamos tu pago</h1>
		<p>Ahora puedes iniciar sesión en la plataforma, crear pacientes entre otras cosas mas.</p>
		<p>Ahora por favor, confirma tu cuenta.</p>
		<p class="container-button">
			<a href="{{ route('email.verify', $data->confirmation_code) }}" class="button">Confirmar Email</a>
		</p>
		<p>Cualquier duda, contactanos, estamos para ayudarte.</p>

	</div>
</body>
</html>