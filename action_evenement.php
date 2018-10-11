<?php

	session_start();

	$host = "localhost";
	$dbname = "id7403838_workshop";
	$id_db = "id7403838_workshop";
	$mdp_db = "password";

	try
	{
	    // create connexion
		$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $id_db, $mdp_db);
	}

	catch (PDOException $e)
	{
	     print "Erreur !: " . $e->getMessage() . "<br/>";
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_can']) && isset($_POST['action']))
	{
		if ($_POST['action'] == 'ac')
		{
			$sql = "UPDATE candidature set etat='accepte' WHERE id_candidature=".$_POST['id_can'];
			$dbh->query($sql);
		}
		if ($_POST['action'] == 're')
		{
			$sql = "UPDATE candidature set etat='refuse' WHERE id_candidature=".$_POST['id_can'];
			$dbh->query($sql);
		}
		if ($_POST['action'] == 'an')
		{
			$sql = "DELETE FROM candidature WHERE id_candidature=".$_POST['id_can'];
			$dbh->query($sql);
		}
		header('location: evenement.php?id='.$_POST['id']);
		exit();
	}else{ echo "une erreure s'est produite!";}

	$dbh = null;
?>
