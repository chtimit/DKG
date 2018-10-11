<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
	<title>consulter</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<a href="accueil.php"><img src="src/log12.png"> </a>
	<?php session_start();
		if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
		{?>
			<a href="connexion.php" class="button2"> Connexion	</a>
			<a href="inscription.php" class="button1"> Inscription</a>
			<a href="profil.php" class="button3"> Profil </a>
		<?php } else { ?>
			<a href="deconexion.php" class="button2"> Déconexion</a>
			<a href='profil.php?id=<?php echo ($_SESSION['id_compte']."'"); ?> class="button3"> Profil </a>
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

	if (!isset($_POST['nom']))
	{
		$_POST['nom'] = "";
	}

	function result($dbh)
	{
		if (isset($_POST['categorie']) && $_POST['categorie'] != 0)
			$sql = "SELECT evenement.id_evenement, evenement.nom_evenement, categorie.categorie FROM evenement LEFT JOIN categorie ON categorie.id_categorie=evenement.categorie WHERE evenement.categorie='".$_POST['categorie']."' AND nom_evenement LIKE '%".$_POST['nom']."%'";
		else
			$sql = "SELECT evenement.id_evenement, evenement.nom_evenement, categorie.categorie FROM evenement LEFT JOIN categorie ON categorie.id_categorie=evenement.categorie WHERE nom_evenement LIKE '%".$_POST['nom']."%'";
		return ($dbh->query($sql));
	}

	?>
</header>
<body>
	<div class="formconsulter">
		<div class="titreevenement">Et toi, qui vas-tu rencontrer ?</div>
		<form method="POST" action="consulter.php">
			<div>
				<label>Catégorie :</label>
				<SELECT name="categorie" class="champsblanc">
					<option value='0'>Tout</option>
					<?php
						$sql = "SELECT * FROM categorie";
						$result = $dbh->query($sql);
						foreach ($result as $categorie) {?>
							<option value=<?php echo ("'".$categorie['id_categorie']."'"); ?>><?php echo ($categorie['categorie']); ?></option>
						<?php }?>
				</SELECT>
			</div>
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<div>
				<button type='submit' class="btnvisualiser">Visualiser</button>
			</div>
		</form>
	</div>
	<div class="detailevenement">
			<?php
			$result = result($dbh);
			foreach ($result as $eve) {?>
				<li style="list-style-type:none;">
					<label>Catégorie : </label><label class="label2"><?php echo ($eve['categorie']) ?></label>
					<label>Titre : </label><label class="label2"><?php echo ($eve['nom_evenement']) ?></label>
					<form method="GET" action='evenement.php?'>
						<input type="hidden" name="id" value=<?php echo ("'".$eve['id_evenement']."'"); ?>>
						<button type="submit" class="btndetail">Détail</button>
					</form>
				</li>
			<?php }?>

	</div>
</body>
<?php $dbh = null; ?>
</html>
