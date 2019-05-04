<?php
require '_header.php';

// chargement de la base de donne
$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

if(isset($_SESSION['id']))
{
$req=$bdd->prepare("SELECT * FROM acheteurs WHERE id=?");
$req->execute(array($_SESSION['id']));
$client=$req->fetch();

echo '<h4 id="icone">'.$client["pseudo"].'<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a></h4>';


}





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
	</head>


	<body>
		<div id="entete">
<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href="panier.php"><img src="images/panier.png" height="50" width="50"></a>
	<p id="num"><?php echo $panier->compterpanier()?></p>
	<a  id="compte" href="accueilconnexion.php">Compte</a>
</div>

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