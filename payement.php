<?php
require '_header.php';

if(!isset($_SESSION['id']))
{
	header('Location: connexion.php');
}

$r = $bdde->prepare("SELECT * FROM acheteurs WHERE id=?");
$r->execute(array($_SESSION['id']));
$acheteurs = $r->fetch();
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
														if(isset($_POST["payement"]))
																		{
																			
																			
																			ini_set( 'display_errors', 1 );
											 
																			    error_reporting( E_ALL );
																			 
																			    $to       = 'Marc  <marcgemayel@gmail.com>';
																					$subject  = 'Test de l\'envoi d\'un message !';
																					$message  = 'Voici un message envoyé depuis un script HTML/PHP !';
																					$headers  = 'MIME-Version: 1.0' . "\n";
																					$headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
																			 
																			    echo "L'email a été envoyé.";
																			    
																		}
							
														
														//enregistrer commande
														$creationcomande= $bdde -> prepare("INSERT INTO commande (ida,quantité,prix)  VALUES(?,?,?)");
														$creationcomande -> execute(array($_SESSION['id'],$_SESSION['nombrearticle'],$_SESSION['prixto']));


														//supprimer articles commander de la bd
														$panier->supprimerarticles('paniermusic','musique');
														$panier->supprimerarticles('panierlivre','livre');
														$panier->supprimerarticles('paniervetement','vetement');
														$panier->supprimerarticles('paniersport','sport');

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


<html>

	<head>
		<title> Payement </title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	</script>
	</head>


	<body>
		<div align="center">
			<img id="societegeneral" src="images/societe.png" height="100" width="400" />
			<h2> PAYEMENT </h2>
			<br />

			<p>Pour vous protéger contre l'utilisation frauduleuse de votre carte bancaire, <br> nous vous demandons la saisie des informations de votre carte afin de les vérifier avec votre banque</p>

			<div id="payement">
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
								<option value="Visa">Visa</option>
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
							<input id="boutonpayer"type="submit" name="payement" value="payer">
							

						
						</td>

						
					</tr>


				</table>

			</form>
		</div>

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