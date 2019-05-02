<?php
//integration initialisatio bd
require '_header.php';
//test pour voir si les variables sont bien recupere
//var_dump($toutproduits);
?>



<!DOCTYPE html>
<html>
<head>
	<title>test </title>
</head>
<body>


	<h2 align="center"> Bonjour </h2>

					
						<table>

						<?php foreach ($toutproduits as  $produit): ?>


							<tr>
								<td align="right">
									<!-- pour le nom -->
									<label for "nom"> <?php echo $produit->nom ?> </label>
								</td>

								<td align="right">
									<label for "nom"> <?php echo number_format($produit->prix,2,',','')?> $</label>
								</td>

								<td align="right">
									<a href="ajoutpanier.php?idp=<?php echo $produit->id ?>" > Ajouter panier </a>
								</td>


							</tr>

							

						<?php endforeach ?>

							<td align="right">
									<a href="deconnexion.php " > Deconnecter </a>
								</td>

							<td align="right">
									<a href="panier.php " > Panier </a>
								</td>
							

						</table>
					


</body>
</html>