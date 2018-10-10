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
	     die();
	}
	
	function verif()//vérification que tout les champs obligatoires sont tous remplis
	{
		if(!(isset($_POST["pseudo"])) || $_POST["pseudo"] == "")
		{
			header('location: connexion.php?error=pseudo');
			exit();;
		}
		if(!(isset($_POST["pwd"])) || $_POST["pwd"] == "")
		{
			header('location: connexion.php?error=pwd');
			exit();;
		}
	}
?>
<?php

	verif();

	//c'est l'heure de vérifié que l'email, numero de tel et pseudo sont pas déja prit

	$sql = "SELECT * FROM `utilisateur`";
	$result = $dbh->query($sql);
	$pseudo_exist = false;
	foreach ($result as $util)
	{
		if ($util['pseudo_utilisateur'] == $_POST['pseudo'])
		{
			$pseudo_exist = true;
			if ($util['mdp_utilisateur'] == $_POST['pwd'])
			{
				$_SESSION['pseudo'] = $util['pseudo_utilisateur'];
				$_SESSION['id_compte'] = $util['id_utilisateur'];
			}
			else
			{
				header("location: connexion.php?error=pwd2");
			}
		}
	}
	if (!$pseudo_exist)
	{
		header ("location: connexion.php?error=pseudo2");
	}

	header ("location: accueil.html");
	exit();
?>
<?php $dbh = null;//deco de la base de donnee ?>