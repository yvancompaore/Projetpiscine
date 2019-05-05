<?php
require '_header.php';

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

if(isset($_GET['id']) AND $_GET['id']>0)
{

	$getid=intval($_GET['id']);
	$reqacheteur=$bdd->prepare("SELECT * FROM acheteurs WHERE id =?");
	$reqacheteur->execute(array($getid));
	$acheteursinfo=$reqacheteur->fetch();




?>
<html>

	<head>
		<title> Votre Compte </title>
		<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	</script>
		
	<link rel="stylesheet" type="text/css" href="styles.css">
	</head>


	<body>
		<div id="entete">
	<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href="panier.php"><img src="images/panier.png" height="50" width="50"></a>
	<p id="num"><?php echo $panier->compterpanier()?></p>
	<a  id="compte" href="accueilconnexion.php">Compte</a>
</div>

	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="accueil.php">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="venteflash.php">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher"name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /><li>
				</form>
			</ul>
		</div>
	</nav>
		<div>
			<!-- on verifie que lutilisateur n'a pas changer l'id -->
			<?php if($acheteursinfo['id']==$_SESSION['id'])
			{ ?>
				<h2> Espace Client <?php echo $acheteursinfo['pseudo'] ?><a href='deconnexion.php'><img src="images/deconnexion.png" with="25" height="25"/></a></h2>
					
					<table>
						<tr>
							
							<td align="left">
								<h3> Information identite </h3>
									<p>Nom:  <?php echo $acheteursinfo['nom'] ?> 
										<br/> Prenom:  <?php echo $acheteursinfo['prenom'] ?>	
										<br/> Pseudo:  <?php echo $acheteursinfo['pseudo'] ?> 
										<br/> <a href='modifierinformation.php'><img src="images/mod.png" height="30" width="100"></a>
									</p>

							</td>
						</tr>

						<tr>
							<td>
								<h3> Information Adresse </h3>
									<P> ADRESSE :  <?php echo $acheteursinfo['adresse'] ?>	
										</br/>
										<a href='modifieradresse.php'><img src="images/modadresse.png" height="30" width="250"> </a>
									</P>
							</td>

						</tr>

						
							
								<tr><td><h3> Dernières Commandes  </h3></td></tr>
									<?php


									$req= $bdd->prepare("SELECT * FROM commande WHERE ida=?");
									$req->execute(array($_GET['id']));
										while($trouver=$req->fetch())
										{
											echo '<tr><td> <p>Quantité '.$trouver["quantité"].' Prix total de la commande '.$trouver["prix"].'€</p></td></tr>';
											
										}
										
											
										
									

									
									?>
									

						<tr>
							<td>
								<h3> Connexion et parametre de sécurité  </h3>
									<P> 
										<br/>
										<a href='modifiermdp.php'> <img src="images/modmdp.png" height="30" width="200"></a>
										</br/>
									</P>
							</td>

						</tr>						

					</table>
			<?php 
			}
			else
			{
				$erreur = "VOUS AVEZ PAS  ACCES AUX AUTRES COMPTES";
			}
			?>

			

			<?php
			//on verifie si il y a une erreur et on laffiche en bas
				if(isset($erreur))
					{
						echo '<font color="red">' .$erreur. " </font>";
					}

			?>
		</div>
	</body>

</html>
<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>
<?php
}
?>