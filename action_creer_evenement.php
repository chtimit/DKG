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
		if(!(isset($_POST["nom"])) || $_POST["nom"] == '')
		{
			header('location: inscription.php?error=nom');
			exit();;
		}
		if(!(isset($_POST["ville"])) || $_POST["ville"] == '')
		{
			header('location: inscription.php?error=ville');
			exit();;
		}
		if(!(isset($_POST["cp"])) || $_POST["cp"] == '')
		{
			header('location: inscription.php?error=cp');
			exit();;
		}
		if(!(isset($_POST["desc"])) || $_POST["desc"] == '')
		{
			header('location: inscription.php?error=desc');
			exit();;
		}
	}

	function verif_cp()//verification que le code postal et le numéro de téléphone sont composé uniquement de numéro et de bonne longueur
	{
		$cp = str_split($_POST['cp']);

		if (strlen($_POST['cp']) != 5)
		{
			header("location: inscription.php?error=cp");
			exit();
		}

		foreach ($cp as $char)
		{
			if ($char < '0' || $char > '9')
			{
				header("location: inscription.php?error=cp");
				exit();
			}
		}
	}
?>
<?php

	verif();
	verif_cp();

	//c'est l'heure de la création du compte
	$sql = "INSERT INTO evenement(nom_evenement, ville_evenement, cp_evenement, categorie, description_evenement, id_utilisateur)values('".$_POST['nom']."', '".$_POST['ville']."', '".$_POST['cp']."', '".$_POST['categorie']."', '".$_POST['desc']."', '".$_SESSION['id_compte']."')";
	$dbh->exec($sql);
	header("location: consulter.php");
	exit();
?>
<?php $dbh = null;//deco de la base de donnee ?>