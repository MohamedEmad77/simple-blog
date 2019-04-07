<?php 
	function checkInput($var){
	    $var = htmlspecialchars($var);
	    $var = trim($var);
	    $var = stripcslashes($var);
	    return $var;
	}
?>