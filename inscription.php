<?php

require '_header.php';

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

//verification clic boutton d'inscription
if(isset($_POST['validation']))
{	
	//verification qu'il n'y ait pas de code html inséré
	$nom=htmlspecialchars($_POST['nom']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$adresse=htmlspecialchars($_POST['adresse']);
	$email1=htmlspecialchars($_POST['email1']);
	$email2=htmlspecialchars($_POST['email2']);
	$pseudo=htmlspecialchars($_POST['pseudo']);
	//utilisation de la table de hashage pour le mdp
	$mdp1=sha1($_POST['mdp1']);
	$mdp2=sha1($_POST['mdp2']);
	



	//verification si toutes les cases sont remplis
	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['email1']) AND !empty($_POST['email2']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp1']) AND !empty($_POST['mdp2']))
		{
			

			//verification du email
			if($email1 == $email2 )
				{
					if (filter_var($email1, FILTER_VALIDATE_EMAIL))
						{
							$testmail = $bdd -> prepare("SELECT * FROM acheteurs WHERE mail = ?");
							$testmail -> execute(array($email1));
							$emailexiste= $testmail->rowCount();

							if($emailexiste==0)
							{
								//verification des mdp
								if($mdp1== $mdp2)
									{

										$creationmembre= $bdd -> prepare("INSERT INTO acheteurs(nom,prenom,adresse,mail,pseudo,mdp)  VALUES(?,?,?,?,?,?)");
										$creationmembre -> execute(array($nom,$prenom,$adresse,$email1,$pseudo,$mdp1));
										$erreur ="votre compte a bien été créé <a href=\"connexion.php\"> Se connecter </a> ";

										
									}
								else
									{
										$erreur ="Veuillez ressayer car Mot de passe de sont differents";
									}
							}

							else
							{
								$erreur =" ce mail existe deja veuillez recommencer";
							}
						}

					else
						{
							$erreur =" Veuillez reessayer adresse mail non valide  ";
						}
				}
			else
				{
					$erreur = "Veuillez ressayer car les emails sont differents";
				}


		}
	else
		{
			$erreur ="Veuillez remplir tous les champs ";

		}
}


?>

<html>

	<head>
		<title> INSCRIPTION </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	</script>
		
	<link rel="stylesheet" type="text/css" href="styles.css">
	</head>


	<body>
		<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href="panier.php"><img src="images/panier.png" height="50" width="50"></a>
	<p id="num"><?php echo $panier->compterpanier()?></p>
	<a  id="compte" href="accueilconnexion.php">Compte</a>

	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="accueil.php">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="#">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher" name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /></li>
				</form>
			</ul>
		</div>
	</nav>
		<div align="center">
			<h2> Inscription </h2>
			<br /> <br/> 

			<!-- creation d'un formulaire d'inscription -->


			<form method="POST" action ="">
				<!--creation d'un tableau-->
				<table>
					<tr>
						<td align="right">
							<!-- pour le nom -->
							<label for "nom">Nom :</label>
						</td>

						<td align="right">
							<input type="text" placeholder="votre nom" name="nom"  value="<?php if(isset($nom)) {echo $nom;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour le prenom -->
							<label for "prenom">Prenom :</label>
						</td>

						<td align="right">
							<input type="text" placeholder="votre prenom" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour l'adresse -->
							<label for "adresse">Adresse :</label>
						</td>

						<td align="right">
							<input type="text" placeholder="votre Adresse" name="adresse" value="<?php if(isset($adresse)) {echo $adresse;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour l'email' -->
							<label for "email1">Email :</label>
						</td>

						<td align="right">
							<input type="email" placeholder="votre Email" name="email1" value="<?php if(isset($email1)) {echo $email1;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- confirmation pour l'email -->
							<label for "email2">Confirmation email :</label>
						</td>

						<td align="right">
							<input type="text" placeholder=" Confirmer votre email" name="email2" value="<?php if(isset($email2)) {echo $email2;} ?>" />
						</td>
					</tr>


					<tr>
						<td align="right">
							<!-- pour le speudo -->
							<label for "pseudo">Pseudo :</label>
						</td>

						<td align="right">
							<input type="text" placeholder="votre Pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour le mdp -->
							<label for "mdp1">Mot de passe :</label>
						</td>

						<td align="right">
							<input type="password" placeholder="votre MDP" name="mdp1">
						</td>
					</tr>

					<tr>
						<td align="right">
							<!--confirmation pour le mdp -->
							<label for "mdp2">Confirmation mot de passe :</label>
						</td>

						<td align="right">
							<input type="password" placeholder=" Confirmer votre MDP" name="mdp2">
						</td>
					</tr>

					<tr>

						<td>

						</td>


						<td >
							<br/>
							<input type="submit" name="validation" value="S'INSCRIRE">
						</td>

						
					</tr>


				</table>

			</form>

			<?php
			//on verifie si il y a une erreur et on laffiche en bas
				if(isset($erreur))
					{
						echo '<font color="red">' .$erreur. " </font>";
					}

			?>
		</div>
	</body>
	<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>

</html>