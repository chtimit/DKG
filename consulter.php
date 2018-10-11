<!DOCTYPE html>
<html>
<head>
	<title>consulter</title>
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
</head>
<body>
	<div>
		<form method="POST" action="consulter.php">
			<div>
				<label>Catégorie :</label>
				<SELECT name="categorie">
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
				<input type="text" name="nom" <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<div>
				<button type='submit'>Visualiser</button>
			</div>
		</form>
	</div>
	<div>
		<ul style="list-style-type:none;">
			<?php
			$result = result($dbh);
			foreach ($result as $eve) {?>
				<li>
					<ul><?php echo ($eve['categorie']) ?></ul>
					<ul><?php echo ($eve['nom_evenement']) ?></ul>
					<ul><form method="GET" action='evenement.php?'>
						<input type="hidden" name="id" value=<?php echo ("'".$eve['id_evenement']."'"); ?>>
						<button type="submit">Voir</button>
					</form></ul>
				</li>
			<?php }?>
		</ul>
	</div>
</body>
<?php $dbh = null; ?>
</html>
