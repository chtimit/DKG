<?php
	session_start();
	unset($_SESSION['id_compte']);
	unset($_SESSION['login']);
	header('location: accueil.php');
	exit();
?>