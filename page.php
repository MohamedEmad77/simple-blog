<?php 
	require('includes/config.inc.php');
	try {
		if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
			throw new Exception("Invalid Id");	
		}
		$q = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %M %Y") AS dateAdded FROM pages WHERE id=:id';
		$stmt = $pdo->prepare($q);
		$r = $stmt->execute(array(':id' => $_GET['id']));
		if ($r) {
			$stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
			$page = $stmt->fetch();
			if ($page) {
				$pageTitle = $page->getTitle();
				include('includes/header.inc.php');
                include('views/page.html');
			} else throw new Exception("Invalid Id");	
		} else throw new Exception("Invalid Id");	
	} catch (Exception $e) {
			$pageTitle = 'Error!';
			include('includes/header.inc.php');
			include('views/error.html');
		 }


 	include('includes/footer.inc.php');
 ?>