<?php
require '_header.php';
$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');


	if(isset($_GET['supp']))
			{
				

				$panier->supprimer($_GET['supp'],$_GET['nom'],$_GET['pri']);
			}


if(isset($_SESSION['id']))
{
$req=$bdd->prepare("SELECT * FROM acheteurs WHERE id=?");
$req->execute(array($_SESSION['id']));
$client=$req->fetch();



echo '<h4 id="icone">'.$client["pseudo"].'<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a></h4>';


}
?>

<html>
<head>
	<title></title>
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

	<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href="panier.php"><img src="images/panier.png" height="50" width="50"></a>
	<a  id="compte" href="accueilconnexion.php">Compte<?php

	?></a>

	
	

	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="accueil.php">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="#">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher"name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /><li>
				</form>
			</ul>
		</div>
	</nav>


	<h3 id="panierpresentation" align="center">Panier</h3>
	<div id="itemspanier" align="center">
	<table><tr>
				<?php
				if($_SESSION['nombrearticle']==0)
						{ ?>
							<p id="infopanier">Votre panier n'attend qu'à être rempli</p>
						<?php }
				//appel de la fonction afficher dans panier class
				$panier->afficher('paniermusic','musique');
				$panier->afficher('panierlivre','livre');
				$panier->afficher('paniervetement','vetement');
				$panier->afficher('paniersport','sport');
				





		?>
		

			<!--afficher le prix total -->
			<td align="right">
				<br>
				<label for "Nombre darticle "> Nombre d'articles <?php echo $_SESSION['nombrearticle'] ?> </label>
			</td>


			<!--afficher le nombre d'articles -->
			<td align="right">
				
				<h3><label for "Prixtotal"> Prix total <?php echo number_format($_SESSION['prixto'])?> €</label></h3>
				

			</td>


			<!--lien passer la commande -->
			<td align="right">

				<?php
				if($_SESSION['nombrearticle']!=0)
				{ ?>
					<p>Passez la commande<a href="payement.php" ><img id="imageitem" src="images/camion"width="50" height="50"></a></p>
				<?php }?>
				



				

			</td></tr>

			

	</table>
</div>


</body>
<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>
</html>