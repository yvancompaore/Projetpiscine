<?php
session_start();

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

if(isset($_GET['id']) AND $_GET['id']>0)
{

	$getid=intval($_GET['id']);
	$reqacheteur=$bdd->prepare("SELECT * FROM acheteurs WHERE id =?");
	$reqacheteur->execute(array($getid));
	$acheteursinfo=$reqacheteur->fetch();




?>



<!DOCTYPE html>
<html>

	<head>
		<title> Votre Compte </title>
	</head>


	<body>
		<div >
			<h1 align="center"> COMPTE </h1>
			<br /> <br/> 

			<!-- on verifie que lutilisateur n'a pas changer l'id -->
			<?php if($acheteursinfo['id']==$_SESSION['id'])
			{ ?>
				<h2 align="center"> Bonjour <?php echo $acheteursinfo['pseudo'] ?></h2>
					
					<table>
						<tr>
							
							<td align="left">
								<h3> Information identite </h3>
									<p>Nom:  <?php echo $acheteursinfo['nom'] ?> 
										<br/> Prenom:  <?php echo $acheteursinfo['prenom'] ?>	
										<br/> Pseudo:  <?php echo $acheteursinfo['pseudo'] ?> 
										<br/> <a href='modifierinformation.php'> Modifier </a>
									</p>

							</td>
						</tr>

						<tr>
							<td>
								<h3> Information Adresse </h3>
									<P> ADRESSE :  <?php echo $acheteursinfo['adresse'] ?>	
										</br/>
										<a href='modifieradresse.php'> Changez adresse de Livraison </a>
									</P>
							</td>

						</tr>

						<tr>
							<td>
								<h3> Vos COMANDES  </h3>
									<P> articles ........
										</br/>
									</P>
							</td>

						</tr>

						<tr>
							<td>
								<h3> Connexion et parametre de sécurité  </h3>
									<P> Modifier mdp  ........
										<br/>
										<a href='modifiermdp.php'> Changer Mot de passe </a>
										</br/>
									</P>
							</td>

						</tr>

						<tr>
							<td>
								<h3> Deconnexion </h3>
										<a href='deconnexion.php'> Se deconnecter </a>
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
<?php
}
?>