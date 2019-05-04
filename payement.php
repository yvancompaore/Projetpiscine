<?php
require '_header.php';

if(!isset($_SESSION['id']))
{
	header('Location: connexion.php');
}



//verification clic boutton d'inscription
if(isset($_POST['payement']))
{	
	//verification qu'il n'y ait pas de code html inséré
	$nom=htmlspecialchars($_POST['nomp']);
	$typedecarte=htmlspecialchars($_POST['typedecarte']);
	$dateexpi=htmlspecialchars($_POST['dateexpi']);
	$numcb=sha1($_POST['numcb']);

	//utilisation de la table de hashage pour le mdp
	$mdp=sha1($_POST['mdp']);
	



	//verification si toutes les cases sont remplis
	if(!empty($_POST['nomp']) AND !empty($_POST['typedecarte']) AND !empty($_POST['dateexpi']) AND !empty($_POST['numcb']) AND !empty($_POST['mdp']) )
		{
	
		

				if (strlen($_POST['numcb'])==12)
				{
					
							$testbanque = $bdd->requette('SELECT * FROM compte WHERE ida=:id',array('id' => $_SESSION['id']));
						
							
								
								//verification des informations
								if($nom== $testbanque[0]->nom)
									{
										
										
										if($numcb== $testbanque[0]->numc)
										{

											if($mdp==$testbanque[0]->mdp)
											{

												
												if($dateexpi == $testbanque[0]->date)
												{
													if($typedecarte==$testbanque[0]->type)
													{
														
														echo"votre commande a bien été prise en compte Merci pour votre achat";
														var_dump( $_SESSION['prixto']);
														//enregistrer commande
														$creationcomande= $bdde -> prepare("INSERT INTO commande (ida,quantité,prix)  VALUES(?,?,?)");
														$creationcomande -> execute(array($_SESSION['id'],$_SESSION['nombrearticle'],$_SESSION['prixto']));


														//vider panier

														$panier->vider();



													}

													else
													{
														$erreur ="echec transaction 1";
													}

												}
												else
												{
													$erreur ="echec transaction 2";
												}

											}
											else
											{
												$erreur ="echec transaction 3";
											}




										}
										else
										{
											$erreur ="echec transaction 4";
										}




										
									}
								else
									{
										$erreur ="echec transaction 5";
									}
							
			
				}


				else
				{
					$erreur ="Numero de carte incorrect ";

				}

		}
	else
		{
			$erreur ="Veuillez remplir tous les champs ";

		}
}


?>



<!DOCTYPE html>
<html>

	<head>
		<title> INSCRIPTION </title>
	</head>


	<body>
		<div align="center">
			<h2> PAYEMENT </h2>
			<br /> <br/> 

			<!-- creation d'un formulaire de payement -->


			<form method="POST" action ="">
				<!--creation d'un tableau-->
				<table>
					<tr>
						<td align="right">
							<!-- pour le nom propriétaire -->
							<label for "nom">Nom Proprietaire :</label>
						</td>

						<td align="right">
							<input type="text" placeholder="votre nom" name="nomp" value="<?php if(isset($nom)) {echo $nom;} ?>"   />
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour le numero cb -->
							<label for "carteBancaire">Numero carte bancaire:</label>
						</td>

						<td align="right">
							<input type="number" placeholder="Numero CB" name="numcb" />
						</td>
					</tr>
					
					<tr>
						<td align="right">
							<!-- pour le mdp -->
							<label for "mdp"> Cryptogramme :</label>
						</td>

						<td align="right">
							<input type="password" placeholder="votre Cryptogramme" name="mdp">
						</td>
					</tr>



					<tr>
						<td align="right">
							<!-- pour le type de carte -->
							<label for "typecarte">Type de carte :</label>
						</td>

						<td align="right">
							<select name="typedecarte">
								<option value=""> Selectionner</option>
								<option value="Visa"> Visa</option>
								<option value="Master card"> Master card</option>
								<option value="American express"> American express</option>
							</select>
						</td>
					</tr>

					<tr>
						<td align="right">
							<!-- pour la date d'expiration -->
							<label for "Dated'expiration">Date d'expiration:</label>
						</td>

						<td align="right">
							<input type="date" name="dateexpi" value="<?php if(isset($dateexpi)) {echo $dateexpi;} ?>" />
						</td>
					</tr>




					

					

						<td >
							<br/>
							<input type="submit" name="payement" value="payer">
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

</html>