<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">

<header>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<a href="accueil.php"><img src="src/log12.png"> </a> 
	<title>Ici à Brest</title>

	<?php session_start();
		if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
		{?>
			<a href="connexion.php" class="button2"> Connexion	</a>
			<a href="inscription.php" class="button1"> Inscription</a>
			<a href="profil.php" class="button3"> Profil </a>
		<?php } else { ?>
			<a href="deconexion.php" class="button2"> Déconexion</a>
	<?php } ?>

</header>
<body>
	<section id="main-image">
		<div class="blabla">
			<h2> Organiser votre <br><strong> évènement</strong></h2>
			<div class="boutons">
				<a href="creer.php" class="creereve">Créer</a>
				<a href="consulter.php" class="consultereve">Consulter</a>
			</div>
			<h4>Ici à Brest permet de mettre en lien tous les étudiants en leur offrant une expérience<br> d’utilisation optimale et contribue à créer des opportunités de rencontres et de partages.</h4>
		</div>
	</section>
</body>
</html>