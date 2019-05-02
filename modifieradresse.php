<?php
session_start();

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

if(isset($_SESSION['id']))
{

	$reqacheteur=$bdd->prepare("SELECT * FROM acheteurs WHERE id =?");
	$reqacheteur->execute(array($_SESSION['id']));
	$acheteursinfo=$reqacheteur->fetch();

	if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $acheteursinfo['adresse'] )
	{
		$newadresse=htmlspecialchars($_POST['newadresse']);
		$modifadresse= $bdd->prepare("UPDATE acheteurs SET adresse =?  WHERE id= ? ");
		$modifadresse->execute(array($newadresse,$_SESSION['id']));
		header('Location: compte.php?id='.$_SESSION['id']);
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
									<!-- pour l'adresse -->
									<label for "adresse">Adresse :</label>
								</td>

								<td align="right">
									<input type="text" placeholder="votre Adresse" name="newadresse" value="<?php echo $acheteursinfo['adresse'] ?>"/>
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