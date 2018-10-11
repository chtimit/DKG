<!DOCTYPE html>
<html>
<head>
	<title>consulter</title>
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

	function result($dbh)
	{
		$sql = "SELECT evenement.id_evenement, evenement.nom_evenement, categorie.categorie, utilisateur.pseudo_utilisateur, evenement.cp_evenement, evenement.ville_evenement, evenement.description_evenement FROM evenement LEFT JOIN categorie ON categorie.id_categorie=evenement.categorie LEFT JOIN utilisateur ON utilisateur.id_utilisateur=evenement.id_utilisateur WHERE evenement.id_evenement='".$_GET['id']."'";
		return ($dbh->query($sql));
	}

	if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['id']) || $_GET['id'] < 1)
	{
		
		header('location: accueil.php');
		exit();
	}

	$result = result($dbh);
	foreach ($result as $eve) {}

	?>
</head>
<body>
	<div>
		<div>
			<label>Nom :</label><label><?php echo($eve['nom_evenement']) ?></label>
		</div>
		<div>
			<label>Ville :</label><label><?php echo($eve['cp_evenement']) ?></label><label><?php echo($eve['ville_evenement']) ?></label>
		</div>
		<div>
			<label>categorie :</label><label><?php echo($eve['categorie']) ?></label>
		</div>
		<div>
			<label>Créateur :</label><label><?php echo($eve['pseudo_utilisateur']) ?></label>
		</div>
		<div>
			<label>Description :</label><label><?php echo($eve['description_evenement']) ?></label>
		</div>
	</div>
	<div>
		<form method='GET' action="">
			<input type="hidden" name="id" value=<?php echo ("'".$eve['id_evenement']."'") ?>>
			<input type="hidden" name="id_util" value=<?php if (isset($_SESSION['id_compte'])){echo ("'".$_SESSION['id_compte']."'");}else{echo ("'0'");} ?>>
			<button type='submit'>Proposer sa candidature</button>
		</form>
	</div>
</body>
<?php $dbh = null; ?>
</html>