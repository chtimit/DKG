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
	     die();
	}
	
	function verif()//vérification que tout les champs obligatoires sont tous remplis
	{
		if(!(isset($_POST["nom"])) || $_POST["nom"] == '')
		{
			header('location: inscription.php?error=nom');
			exit();;
		}
		if(!(isset($_POST["prenom"])) || $_POST["prenom"] == '')
		{
			header('location: inscription.php?error=prenom');
			exit();;
		}
		if(!(isset($_POST["pseudo"])) || $_POST["pseudo"] == '')
		{
			header('location: inscription.php?error=pseudo');
			exit();;
		}
		if(!(isset($_POST["mdp"])) || $_POST["mdp"] == '')
		{
			header('location: inscription.php?error=mdp');
			exit();
		}
		if (!(isset($_POST["mdp2"])) || $_POST["mdp2"] == '')
		{
			header('location: inscription.php?error=mdp2');
			exit();;
		}
		if ($_POST['mdp'] != $_POST['mdp2'])
		{
			header('location: inscription.php?error=mdp3');
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
		if(!(isset($_POST["telephone"])) || $_POST["telephone"] == 0)
		{
			header('location: inscription.php?error=tele');
			exit();;
		}
	}

	function verif_mail()//vérification que l'email à une forme d'adresse email (***@**.**)
	{
		$arob = 0;
		$point = 0;
		$tab = str_split($_POST['mail']);
		foreach ($tab as $char)
		{
			if ($char == '@')
				$arob += 1;
			if ($char == '.' && $arob != 0)
				$point += 1;
		}
		if ($arob == 0 || $point == 0)
		{
			header("location: inscription.php?error=mail");
			exit();
		}
	}

	function verif_cptel()//verification que le code postal et le numéro de téléphone sont composé uniquement de numéro et de bonne longueur
	{
		$cp = str_split($_POST['cp']);
		$tel = str_split($_POST['telephone']);

		if (strlen($_POST['telephone']) != 10)
		{
			header("location: inscription.php?error=tele");
			exit();
		}
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
		foreach ($tel as $char)
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
	verif_mail();
	verif_cptel();

	//c'est l'heure de vérifié que l'email, numero de tel et pseudo sont pas déja prit
	$sql = "SELECT * FROM `utilisateur`";
	$result = $dbh->query($sql);
	foreach ($result as $util) {
		if ($util['email_utilisateur'] == $_POST['mail'])
		{
			header("location: inscription.php?error=mail2");
			exit();
		}
		if ($util['pseudo_utilisateur'] == $_POST['pseudo'])
		{
			header("location: inscription.php?error=pseudo2");
			exit();
		}
		if ($util['telephone_utilisateur'] == $_POST['telephone'])
		{
			header("location: inscription.php?error=tele2");
			exit();
		}
	}

	//c'est l'heure de la création du compte
	$sql = "INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, ville_utilisateur, cp_utilisateur, telephone_utilisateur, email_utilisateur, pseudo_utilisateur, mdp_utilisateur, sexe)values('".$_POST['nom']."', '".$_POST['prenom']."', '".$_POST['ville']."', '".$_POST['cp']."', '".$_POST['telephone']."', '".$_POST['mail']."', '".$_POST['pseudo']."', '".$_POST['mdp']."', '".$_POST['sexe']."')";
	$dbh->exec($sql);
	header("location: accueil.php");
	exit();
?>
<?php $dbh = null;//deco de la base de donnee ?>
