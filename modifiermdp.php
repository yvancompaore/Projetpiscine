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
	<a id ="panier" href=""><img src="images/panier.png" height="50" width="50"></a>
	<a  id="compte" href="accueilconnexion.php">Compte</a>
</div>

	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="TD_5.html">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="#">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher"name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /><li>
				</form>
			</ul>
		</div>
	</nav>
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