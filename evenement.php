<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
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
			<a href="profil.php" class="button3"> Profil </a>
	<?php } ?>

	<title>Evenement</title>
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
			}
		}
		return (true);
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
</header>
<body>
	<div class="formconsulter">
		<div>
			<label>Nom :</label><label class="label2"><?php echo($eve['nom_evenement']) ?></label>
		</div>
		<div>
			<label>Ville :</label><label class="label2"><?php echo($eve['cp_evenement']) ?></label><label class="label2"><?php echo($eve['ville_evenement']) ?></label>
		</div>
		<div>
			<label>Catégorie :</label><label class="label2"><?php echo($eve['categorie']) ?></label>
		</div>
		<div>
			<label>Créateur :</label><label class="label2"><?php echo($eve['pseudo_utilisateur']) ?></label>
		</div>
	</div>
	<div class="descriptionrelou">
		<label>Description :</label><textarea DISABLED class="labelrelou"><?php echo($eve['description_evenement']) ?></textarea>
	</div>
	<div>
		<form method='GET' action="">
			<input type="hidden" name="id" value=<?php echo ("'".$eve['id_evenement']."'") ?>>
			<input type="hidden" name="id_util" value=<?php if (isset($_SESSION['id_compte'])){echo ("'".$_SESSION['id_compte']."'");}else{echo ("'0'");} ?>>
				<button type='submit' class="btncandidature">Proposer sa candidature</button>
		</form>
	</div>
	<div class="titreliste">Liste Participant :</div>
	<div class="liste">
		<?php  
		$sql = "SELECT utilisateur.pseudo_utilisateur, candidature.etat, candidature.id_candidature, candidature.id_utilisateur FROM candidature LEFT JOIN utilisateur ON candidature.id_utilisateur=utilisateur.id_utilisateur WHERE candidature.id_evenement=".$_GET['id']." ORDER BY etat";
		$res = $dbh->query($sql);
		foreach ($res as $can) { ?>
			<div class="aligner">
				<label><?php echo ($can['pseudo_utilisateur']) ?></label>
				<label class="etateve"><?php echo ($can['etat']) ?></label>
				<?php if (!isset($_SESSION['login']) || ($_SESSION['id_compte'] != $eve['id_utilisateur'] && $_SESSION['id_compte'] != $can['id_utilisateur']) ||  ($can['etat'] == 'accepte' || $can['etat'] == 'refuse')) { ?>


				<?php } else if ($_SESSION['id_compte'] == $eve['id_utilisateur']){ ?>

					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="ac">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button class="btnchoix" type="submit">Accepter</button>
					</form>
					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="re">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button class="btnchoix" type="submit">Refuser</button>
					</form>
					
				<?php } else { ?>

					<form method="POST" action="action_evenement.php">
						<input type="hidden" name="id_can" value=<?php echo ($can['id_candidature']); ?>>
						<input type="hidden" name="action" value="an">
						<input type="hidden" name="id" value=<?php echo ($_GET['id']); ?>>
						<button class="btnannuler" type="submit">Annuler</button>
					</form>

				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div>
        <?php
        $sql = "SELECT * FROM candidature WHERE id_evenement=".$_GET['id']." AND id_utilisateur=".$_SESSION['id_compte'];
        $res = $dbh->query($sql);
        foreach ($res as $ver) {}
        if (!isset($ver) || !isset($ver['id_candidature']))
        {}
        else
        {?>
        <form method="POST" class="formconsulter" action="poster.php">
            <label>Laisser un commentaire :</label>
            <input type="hidden" name="id_utilisateur" value=<?php echo ("'".$_SESSION['id_compte']."'"); ?>>
            <input type="hidden" name="id_evenement" value=<?php echo ("'".$_GET['id']."'"); ?>>
            <input type="radio" name="note" value="1">
            <input type="radio" name="note" value="2">
            <input type="radio" name="note" value="3">
            <input type="radio" name="note" value="4">
            <input type="radio" name="note" value="5" checked>
            <textarea name="text" class="textarearelou"></textarea>
            <button type="submit" class="btncommentaire">Poster</button>
        </form>
        <?php } ?>
    </div>
    <div>
        <?php
        $sql = "SELECT utilisateur.pseudo_utilisateur, commentaire.texte_commentaire, commentaire.eval_commentaire  FROM commentaire LEFT JOIN utilisateur ON commentaire.id_utilisateur=utilisateur.id_utilisateur WHERE commentaire.id_evenement=".$_GET['id'];
        $res = $dbh->query($sql);
        foreach ($res as $com)
        { ?>
            <div class="formconsulter">
                <div>
                    <label>Nom :</label><label class="label2"><?php echo($com['pseudo_utilisateur']) ?></label>
                </div>
                <div>
                    <label>Note :</label><label class="label2"><?php echo($com['eval_commentaire']) ?></label>
                </div>
            </div>
            <div class="descriptionrelou">
                <textarea DISABLED class="labelrelou"><?php echo($com['texte_commentaire']) ?></textarea>
            </div>
        <?php } ?>
    </div>
</body>
<?php $dbh = null; ?>
</html>