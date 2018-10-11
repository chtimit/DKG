<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<a href="accueil.php"><img src="src/log12.png"> </a> 
	<title>Profil</title>
	<?php session_start();
		if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
		{?>
			<a href="connexion.php" class="button2"> Connexion	</a>
			<a href="inscription.php" class="button1"> Inscription</a>
			<a href="profil.php" class="button3"> Profil </a>
		<?php } else { ?>
			<a href="deconexion.php" class="button2"> Déconexion</a>
			<a href="profil.php" class="button3"> Profil </a>
	<?php } ?>
	<?php
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
	if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['id']) || $_GET['id'] < 1)
	{
		header('location: connexion.php');
		exit();
	}
	if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
	{
		header('location: connexion.php');
		exit();
	}
	$sql = "SELECT * FROM utilisateur WHERE id_utilisateur=".$_GET['id'];
	$result = $dbh->query($sql);
	foreach ($result as $util) {}
	?>
</header>
<body>
	<div class="formprofil">
		<div class="titreprofil">Mon profil</div>
		<div>
			<label>Nom :</label><label><?php echo($util['prenom_utilisateur']) ?></label> <label><?php echo($util['nom_utilisateur']) ?></label>
		</div>
		<div>
			<label>Ville :</label><label><?php echo($util['cp_utilisateur']) ?></label> <label><?php echo($util['ville_utilisateur']) ?></label>
		</div>
		<div>
			<label>Pseudo :</label><label><?php echo($util['pseudo_utilisateur']) ?></label>
		</div>
		<div>
			<label>Email :</label><label><?php echo($util['email_utilisateur']) ?></label>
		</div>
	</div>
	<div>
		
	</div>
</body>
<?php $dbh = null; ?>
</html>