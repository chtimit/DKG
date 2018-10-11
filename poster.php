<?php

	session_start();

	$host = "localhost";
	$dbname = "workshop";
	$id_db = "root";
	$mdp_db = "";

	try
	{
	    // create connexion
		$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $id_db, $mdp_db);
	}

	catch (PDOException $e)
	{
	     print "Erreur !: " . $e->getMessage() . "<br/>";
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_utilisateur']) && isset($_POST['id_evenement']) && isset($_POST['text']) && $_POST['id_utilisateur'] != "" && $_POST['id_evenement'] != '' && $_POST['text'] != "")
	{
		$sql = "INSERT INTO commentaire(id_utilisateur, id_evenement, texte_commentaire, eval_commentaire) values('".$_POST['id_utilisateur']."', '".$_POST['id_evenement']."', '".$_POST['text']."', '".$_POST['note']."')";
		header('location: evenement.php?id='.$_POST['id']);
		exit();
	}else{ echo "une erreure s'est produite!";}

	$dbh = null;
?>