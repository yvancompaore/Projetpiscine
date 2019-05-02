<?php
session_start();

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

if(isset($_SESSION['id']))
{

	$reqacheteur=$bdd->prepare("SELECT * FROM acheteurs WHERE id =?");
	$reqacheteur->execute(array($_SESSION['id']));
	$acheteursinfo=$reqacheteur->fetch();

	if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])  )
	{
		$newmdp1=sha1($_POST['newmdp1']);
		$newmdp2=sha1($_POST['newmdp2']);

		if ($newmdp1 == $newmdp2)
		{
			$changermdp= $bdd->prepare("UPDATE acheteurs SET mdp = ? WHERE id =?");
			$changermdp->execute(array($newmdp1,$_SESSION['id']));
			header('Location: connexion.php?id='.$_SESSION['id'] );
		}

		else
		{
			$erreur ="Veuillez rentrer les meme mot de passe";
		}

		
	}

	


?>



<!DOCTYPE html>
<html>

	<head>
		<title> Votre Compte </title>
	</head>


	<body>
		<div >
			<h1 align="center"> Modifier information </h1>
			<br /> <br/> 

			<!-- on verifie que lutilisateur n'a pas changer l'id -->
			<?php if($acheteursinfo['id']==$_SESSION['id'])
			{ ?>
				<h2 align="center"> Bonjour <?php echo $acheteursinfo['pseudo'] ?></h2>

					<form method="POST" action ="">
						<table>
							

							<tr>
								<td align="right">
									<!-- pour le mdp-->
									<label for "newmdp1">Mot de Passe :</label>
								</td>

								<td align="right">
									<input type="password" placeholder="votre Mot de passe" name="newmdp1" />
								</td>
							</tr>


							<tr>
								<td align="right">
									<!-- pour confirmation -->
									<label for "newmdp2">Confirmation mot de passe :</label>
								</td>

								<td align="right">
									<input type="password" placeholder="Confirmer MDP" name="newmdp2" />
								</td>
							</tr>

							

							<tr>
								<td>
									
								</td>

								<td align="center">
									<br/>
									<input type="submit" name="Mdofier" value="Modifier">
									<br/><br/>
								</td>
							</tr>
							
						</table>
					</form>
					
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
else
{
	header("Location: connexion.php");
}
?>