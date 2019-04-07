<?php 
require('includes/config.inc.php');
include('includes/functions.php');
//print_r($user);
if (!isset($user)) header("Location:login.php");
if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT,array('min_range' => 1))) {
	header("Location:index.php");	
}

$error = "";
if (isset($_POST['submit'])) {
	
	$title = checkInput($_POST['title']);
	$content = checkInput($_POST['content']);
	if (!empty($title) && !empty($content)) {
		$q = "UPDATE pages SET title = :title, content = :content WHERE id = :id";
		$stmt = $pdo->prepare($q);
		$r = $stmt->execute(array(':title' => $title, ':content' => $content, ':id'=>$_POST['id']));
		if ($r) {
			header("Location:page.php?id=".$_POST['id']);
			exit;
		} 
	}else $error = "All fields required";
}
$q = 'SELECT id, title, content FROM pages WHERE id=:id';
    $stmt = $pdo->prepare($q);
	$r = $stmt->execute(array(':id' => $_GET['id']));
	if ($r) {
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
		$page = $stmt->fetch();
		if(!$user->canEditPage($page)) header("Location:index.php");
	}



?>



<?php
$pageTitle = 'Edit Page';
include ('includes/header.inc.php');
include ('views/edit_page.html');
include ('includes/footer.inc.php');
?>