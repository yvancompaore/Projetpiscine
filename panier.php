<?php
require '_header.php';
//on verifie


	if(isset($_GET['supp']))
			{
				

				$panier->supprimer($_GET['supp'],$_GET['nom'],$_GET['pri']);
			}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>



	<table>
				<?php
				//appel de la fonction afficher dans panier class
				$panier->afficher('paniermusic','musique');
				$panier->afficher('panierlivre','livre');
				$panier->afficher('paniervetement','vetement');
				$panier->afficher('paniersport','sport');
				?>






		

			<!--afficher le prix total -->
			<td align="right">

				<label for "Prixtotal"> Prix total <?php echo number_format($_SESSION['prixto']*1.196,2,',','')?> $</label>
			</td>


			<!--afficher le nombre d'articles -->
			<td align="right">

				<label for "Nombre darticle "> Nombre d'article <?php echo $_SESSION['nombrearticle'] ?> </label>
			</td>


			<!--lien passer la commande -->
			<td align="right">
				<br/>
				<a href="panier.php" > Passez la commande </a>
			</td>

			

	</table>


</body>
</html>