<?php
/* Check Login Functions  */

/* Admin  */
function admin()
{
	if ((strlen($_SESSION['id']) == 0)) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php";
		$_SESSION["id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}



/* Clients */
function client()
{
	if ((strlen($_SESSION['id']) == 0) && (strlen($_SESSION['phone']) == 0)) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php";
		$_SESSION["id"] = "";
		$_SESSION['phone'] = "";
		header("Location: http://$host$uri/$extra");
	}
}
