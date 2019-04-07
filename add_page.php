<?php 
require('includes/config.inc.php');
include('includes/functions.php');
//print_r($user);
if (!isset($user)) header("Location:login.php");

$error = "";
if (isset($_POST['submit'])) {
	$title = checkInput($_POST['title']);
	$content = checkInput($_POST['content']);
	if (!empty($title) && !empty($content)) {
		$q = 'INSERT INTO pages (creatorId, title, content, dateAdded) VALUES(:creatorId, :title, :content, NOW())';
		$stmt = $pdo->prepare($q);
		$r = $stmt->execute(array(':creatorId' => $user->getId(), ':title' => $title, ':content' => $content));
		if ($r) {
			// $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
			// $page = $stmt->fetch();
			//print_r($page);
			header("Location:page.php?id=".$pdo->lastInsertId());
			exit;
		} 
	}else $error = "All fields required";
}






?>



<?php
$pageTitle = 'Add Page';
include ('includes/header.inc.php');
include ('views/add_page.html');
include ('includes/footer.inc.php');
?>