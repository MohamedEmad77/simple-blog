<?php 
 require('includes/config.inc.php');


 if ($user) {


 $user = null;


 $_SESSION = array();


 setcookie(session_name(), false, time()-3600);


 session_destroy();
 header("Location:index.php");

 } 
 include('includes/footer.inc.php');
?>