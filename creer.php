<!DOCTYPE html>
<html>
<head>
	<title>créer un évenement</title>
</head>
<body>
	<?php
	session_start();

	if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
	{
		header('location: connexion.php');
		exit();
	}

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

	?>
	<div>
		<form method='POST' action='action_creer_evenement.php'>
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<div>
				<label>Ville :</label>
				<input type="text" name="ville" <?php if (isset($_GET['error']) && $_GET['error'] == "ville") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<div>
				<label>Code Postal :</label>
				<input type="text" name="cp" <?php if (isset($_GET['error']) && $_GET['error'] == "cp") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<div>
				<label>Categorie :</label>
				<SELECT name="categorie">
					<?php
						$sql = "SELECT * FROM categorie";
						$result = $dbh->query($sql);
						foreach ($result as $categorie) {?>
							<option value=<?php echo ("'".$categorie['id_categorie']."'"); ?>><?php echo ($categorie['categorie']); ?></option>
						<?php }?>
				</SELECT>
			</div>
			<div>
				<label>Description :</label>
				<textarea name="desc" style='width: 50%; height: 100px;' <?php if (isset($_GET['error']) && $_GET['error'] == "desc") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>></textarea>
			</div>
			<div>
				<button type='submit'>Créer</button>
			</div>
		</form>
	</div>
</body>
<?php $dbh = null; ?>
</html>