<?php 
require('includes/config.inc.php');
include('includes/functions.php');

if (isset($user)) header("Location:index.php");

$error = "";
if (isset($_POST['submit'])) {
	$email = checkInput($_POST['email']);
	$password = checkInput($_POST['password']);
	if (!empty($email) && !empty($password)) {
		$q = 'SELECT id, userType, username, email FROM users WHERE email=:email AND password=SHA1(:password)';
		$stmt = $pdo->prepare($q);
		$r = $stmt->execute(array(':email' => $email, ':password' => $password));
		if ($r) {
			$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
			$user = $stmt->fetch();
			if ($user) {
				$_SESSION['user'] = $user;
				header("Location:index.php");
				exit;
			} else $error = "Wrong login credentials";


		} 
	}else $error = "All fields required";
}






?>



<?php
$pageTitle = 'login';
include ('includes/header.inc.php');
include ('views/login.html');
include ('includes/footer.inc.php');
?>