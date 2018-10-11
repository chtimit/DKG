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
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_utilisateur']) && isset($_POST['id_evenement']) && isset($_POST['text']) && $_POST['id_utilisateur'] != "" && $_POST['id_evenement'] != '' && $_POST['text'] != "")
	{
		$sql = "INSERT INTO commentaire(id_utilisateur, id_evenement, texte_commentaire, eval_commentaire) values('".$_POST['id_utilisateur']."', '".$_POST['id_evenement']."', '".$_POST['text']."', '".$_POST['note']."')";
		$dbh->query($sql);
        header('location: evenement.php?id='.$_POST['id_evenement']);
        exit();	}else{ echo "une erreure s'est produite!";}
	$dbh = null;
?>
