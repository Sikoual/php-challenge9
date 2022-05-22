<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$_POST = filter_input_array(INPUT_POST, [
		'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'lastname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'email' => FILTER_SANITIZE_EMAIL,
		'cellphone' => FILTER_SANITIZE_NUMBER_INT,
		'subjects' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'message' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
	]);
	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $cellphone = $_POST['cellphone'];
	 $subjects = $_POST['subjects'];
	 $message = $_POST['message'];
}

echo <<<START
Merci $firstname $lastname de nous avoir contactés à propos de "$subjects". 

Un de nos conseiller vous contactera soit à l'adresse $email ou par téléphone
au $cellphone dans les plus brefs délais pour traiter votre demande :

$message
START;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>Challenge 8</title>
</head>
<body>
<form action="form.php" method="post">
	<div>
		<label for="firstname">Prénom</label>
		<input type="text" name="firstname" id="firstname">
	</div>
	<div>
		<label for="lastname">Nom</label>
		<input type="text" name="lastname" id="lastname">
	</div>
	<div>
		<label for="firstname">Email</label>
		<input type="email" name="email" id="email">
	</div>
	<div>
		<label for="cellphone">Numéro portable</label>
		<input type="tel" name="cellphone" id="cellphone">
	</div>
	<div>
		<label for="subjects">Sujets</label>
		<select name="subjects" id="subjects">
			<option value="politic">Politique</option>
			<option value="sport">Sport</option>
			<option value="technology">Technologie</option>
			<option value="business">Business</option>
		</select>
	</div>
	<div>
		<label for="message">Message</label>
		<textarea name="message" id="message"></textarea>
	</div>
	<div class="button">
		<button type="submit">Envoyer votre message</button>
	</div>
</form>
</body>
</html>


