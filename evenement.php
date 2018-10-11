<!DOCTYPE html>
<html>
<head>
	<title>Evenement</title>
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
		$sql = "SELECT evenement.id_evenement, evenement.id_utilisateur, evenement.nom_evenement, categorie.categorie, utilisateur.pseudo_utilisateur, evenement.cp_evenement, evenement.ville_evenement, evenement.description_evenement FROM evenement LEFT JOIN categorie ON categorie.id_categorie=evenement.categorie LEFT JOIN utilisateur ON utilisateur.id_utilisateur=evenement.id_utilisateur WHERE evenement.id_evenement='".$_GET['id']."'";
		return ($dbh->query($sql));
	}

	function verif_libre($dbh, $id, $id_util)
	{
		$sql = "SELECT * FROM candidature WHERE id_evenement=".$id;
		$res = $dbh->query($sql);
		foreach ($res as $can) {
			if ($can['id_utilisateur'] == $id_util)
			{
				return (false);
				header('location: evenement.php?id='.$id.'&error=dej');
				exit();
			}
		}
	}

	if ($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['id']) || $_GET['id'] < 1)
	{
		
		header('location: accueil.php');
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_util']))
	{
		if ($_GET['id_util'] == 0)
		{
			header('location: connexion.php');
			exit();
		}
		else
		{
			if (verif_libre($dbh, $_GET['id'], $_GET['id_util'])) {
				$sql = "INSERT INTO candidature(id_evenement, id_utilisateur) values ('".$_GET['id']."', '".$_GET['id_util']."')";
				$dbh->query($sql);
			}
		}
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
			<?php if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['error']) && $_GET['error'] == 'dej') { ?>
				<label type='error' style='border-style: solid;border-color: red'>déja candidat</label>
			<?php } else { ?>
				<button type='submit'>Proposer sa candidature</button>
			<?php }	?>
		</form>
	</div>
	<div>
		<?php  
		$sql = "SELECT utilisateur.pseudo_utilisateur, candidature.etat, candidature.id_candidature, candidature.id_utilisateur FROM candidature LEFT JOIN utilisateur ON candidature.id_utilisateur=utilisateur.id_utilisateur WHERE candidature.id_evenement=".$_GET['id']." ORDER BY etat";
		$res = $dbh->query($sql);
		foreach ($res as $can) { ?>
			<div>
				<label><?php echo ($can['pseudo_utilisateur']) ?></label>
				<label><?php echo ($can['etat']) ?></label>
				<?php if (!isset($_SESSION['login']) || ($_SESSION['id_compte'] != $eve['id_utilisateur'] && $_SESSION['id_compte'] != $can['id_utilisateur']) ||  ($can['etat'] == 'accepte' || $can['etat'] == 'refuse')) { ?>


				<?php } else if ($_SESSION['id_compte'] == $eve['id_utilisateur']){ ?>

					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="ac">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button type="submit">Accepter</button>
					</form>
					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="re">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button type="submit">Refuser</button>
					</form>
					
				<?php } else { ?>

					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="an">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button type="submit">Annuler</button>
					</form>

				<?php } ?>
			</div>
		<?php } ?>
	</div>
</body>
<?php $dbh = null; ?>
</html>