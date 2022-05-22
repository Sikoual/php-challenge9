<?php
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_NAME_TOO_SHORT = "Veuillez renseigner au moins 2 caractères";
const ERROR_EMAIL = "Veuillez renseigner un email valide";
const ERROR_CELLPHONE = "Veuillez renseigner un numéro de téléphone valide";
const ERROR_MESSAGE_TOO_SHORT = "Votre message doit contenir au moins 20 caractères";

$errors = [
	'firstname' => '',
	'lastname'  => '',
	'email'     => '',
	'cellphone' => '',
	'subjects'  => '',
	'message'   => '',
];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$_POST = filter_input_array(INPUT_POST, [
		'firstname'     => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'lastname'      => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'email'         => FILTER_SANITIZE_EMAIL,
		'cellphone'     => FILTER_SANITIZE_NUMBER_INT,
		'subjects'      => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
		'message'       => [
			'filter'        => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
			'flags'         => FILTER_FLAG_NO_ENCODE_QUOTES
		]
	]);
	$firstname 	    = $_POST['firstname'];
	$lastname 	    = $_POST['lastname'];
	$email 	        = $_POST['email'];
	$cellphone      = $_POST['cellphone'];
	$subjects       = $_POST['subjects'];
	$message        = $_POST['message'];
}


$thank = <<<START
    Merci $firstname $lastname de nous avoir contactés à propos de "$subjects".
    Un de nos conseiller vous contactera soit à l'adresse $email ou par téléphone
    au $cellphone dans les plus brefs délais pour traiter votre demande :
    $message
    START;


if (!$firstname) {
	$errors['firstname'] = ERROR_REQUIRED;
}elseif(mb_strlen($firstname) < 2){
	$errors['firstname'] = ERROR_NAME_TOO_SHORT;
}

if (!$lastname) {
	$errors['lastname'] = ERROR_REQUIRED;
}elseif(mb_strlen($lastname) < 2){
	$errors['lastname'] = ERROR_NAME_TOO_SHORT;
}

if (!$email) {
	$errors['email'] = ERROR_REQUIRED;
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors['email'] = ERROR_EMAIL;
}
if (!$cellphone) {
	$errors['cellphone'] = ERROR_REQUIRED;
}elseif(mb_strlen($cellphone) !== 10){
	$errors['cellphone'] = ERROR_CELLPHONE;
}
if (!$subjects) {
	$errors['subjects'] = ERROR_REQUIRED;
}

if (!$message) {
	$errors['message'] = ERROR_REQUIRED;
}elseif(mb_strlen($message) < 20){
	$errors['message'] = ERROR_MESSAGE_TOO_SHORT;
}

$completeForm = true;
foreach ($errors as $error){
    if(mb_strlen($error) !== 0){
        $completeForm = false;
    }
}
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
		<input type="text" name="firstname" id="firstname" required="required" value= <?= $firstname ?? "" ?> >
        <?php  if ($errors['firstname']) : ?>
            <p class="text-danger"> <?= $errors['firstname'] ?> </p>
        <?php endif; ?>
	</div>
	<div>
		<label for="lastname">Nom</label>
		<input type="text" name="lastname" id="lastname" required="required" value= <?= $lastname ?? "" ?> >
		<?php  if ($errors['lastname']) : ?>
            <p class="text-danger"> <?= $errors['lastname'] ?> </p>
		<?php endif; ?>
	</div>
	<div>
		<label for="firstname">Email</label>
		<input type="email" name="email" id="email" required="required" value= <?= $email ?? "" ?> >
		<?php  if ($errors['email']) : ?>
            <p class="text-danger"> <?= $errors['email'] ?> </p>
		<?php endif; ?>
	</div>
	<div>
		<label for="cellphone">Numéro portable</label>
		<input type="tel" name="cellphone" id="cellphone" required="required" value= <?= $cellphone ?? "" ?> >
		<?php  if ($errors['cellphone']) : ?>
            <p class="text-danger"> <?= $errors['cellphone'] ?> </p>
		<?php endif; ?>
	</div>
	<div>
		<label for="subjects">Sujets</label>
		<select name="subjects" id="subjects">
			<option value="politic">Politique</option>
			<option value="sport">Sport</option>
			<option value="technology">Technologie</option>
			<option value="business">Business</option>
		</select>
		<?php  if ($errors['subjects']) : ?>
            <p class="text-danger"> <?= $errors['subjects'] ?> </p>
		<?php endif; ?>
	</div>
	<div>
		<label for="message">Message</label>
		<textarea name="message" id="message" required="required" value= <?= $message ?? "" ?> ></textarea>
		<?php  if ($errors['message']) : ?>
            <p class="text-danger"> <?= $errors['message'] ?> </p>
		<?php endif; ?>
	</div>
	<div class="button">
		<button type="submit">Envoyer votre message</button>
	</div>
</form>
<div>
  <?php if($completeForm) : ?>
        <p> <?= $thank ?> </p>
  <?php endif; ?>
</div>
</body>
</html>


