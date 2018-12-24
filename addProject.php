<?php

	use App\Models\Project;

	//creamos una instancia de Job y la guardamos con el ORM Eloquent
	if(!empty($_POST)){
		$project = new Project();
		$project->title = $_POST['title'];
		$project->description = $_POST['description'];
		$project->save();
	}
	
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Add Project</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
	    crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<h1>Add Project</h1>
	<form action="addProject.php" method="post">
		<label for="">Titulo</label>
		<input type="text" name="title"><br>
		<label for="">Descripción</label>
		<input type="text" name="description"><br>
		<button type="submit">Enviar</button>
	</form>
</body>
</html>