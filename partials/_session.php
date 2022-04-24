<?php 
 
 $isse = false;

 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
 { 
     $isse = true;
     $_SESSION['userid'] = 0;
     // header("location: loginpage.php");  
 }

?>  