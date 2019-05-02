<?php
require '_header.php';
//on verifie

	if(isset($_GET['supp']))
			{

				$panier->supprimer($_GET['supp']);
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

			//recuper id du tableau
			$idc=array_keys($_SESSION['panier']);
			$implo=implode(',',$idc);

			if (empty($implo))
			{
				echo "panier vide";

			}

			else{
			//recuperer les produits ajouter au paravant
			$produits=$bdd->requette('SELECT * FROM produits WHERE id IN ('.implode(',',$idc).')');

			


		 	foreach ($produits as  $produit): ?>

		
							<tr>
								<td align="right">
									<!-- pour le nom -->
									<label for "nom"> <?php echo $produit->nom ?> </label>
								</td>

								<td align="right">
									<label for "Prix"> <?php echo number_format($produit->prix,2,',','')?> $</label>
								</td>

								<td align="right">
									<label for "Prixtva"> Prix tva <?php echo number_format($produit->prix*1.196,2,',','')?> $</label>
								</td>

								<td align="right">

									<label for "quantite"> <?php echo $_SESSION['panier'][$produit->id] ?> </label>		
								</td>

							<td align="right">
									<a href="panier.php?supp=<?php echo $produit->id ?>" > supprimer </a>
								</td>


							</tr>

							
			<?php
			 endforeach;

			  } 
			?>

			<!--afficher le prix total -->
			<td align="right">

				<label for "Prixtotal"> Prix total <?php echo number_format($panier->total()*1.196,2,',','')?> $</label>
			</td>


			<!--afficher le nombre d'articles -->
			<td align="right">

				<label for "Nombre darticle "> Nombre d'article <?php echo $panier->compterpanier()?> </label>
			</td>

			

	</table>


</body>
</html>