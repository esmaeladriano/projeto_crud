<?php
 if(!isset($_SESSION)){
	session_start();
}
session_destroy();
header("Location:http://localhost/sistema/LOgin\index.php");
?>