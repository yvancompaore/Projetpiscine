<?php
require '_header.php';

$bdd= new DB();
// chargement de la base de donne
//$bdd= new PDO('mysql:host=localhost;dbname=eceshop;charset=utf8','root','');

//test pour voir si le boutton connexion est activé
if(isset($_POST['connexion']))
{
	$email1co= htmlspecialchars($_POST['loginco']);
	$mdp1co=sha1($_POST['mdp1co']);
	
	//verification que tous les champs sont remplis
	if(!empty($email1co) AND !empty($mdp1co))
	{
		$verifacheteur= $bdd->bdd->prepare("SELECT * FROM acheteurs WHERE mail = ? AND mdp = ?");
		$verifacheteur->execute(array($email1co,$mdp1co));
		//permet de compter les lignes qui existe dans la bdd avec le meme mdp et acheteur
		$acheteurexiste=$verifacheteur->rowCount();

		//si il existe 
		if($acheteurexiste==1)

			{
				//on recupere l'id et on le renvoie dans son compte
				$acheteurinfo = $verifacheteur->fetch();
				$_SESSION['id']=$acheteurinfo['id'];
				$_SESSION['pseudo']=$acheteurinfo['pseudo'];
				header("Location: compte.php?id=".$_SESSION['id']);


			}
		else
		{
			$erreur = "Mauvais identifiant ou Mot de passe ressayer";
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
		<title>ECESHOP</title>
	<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	</script>
		
	<link rel="stylesheet" type="text/css" href="styles.css">	
	</head>


	<body>
		<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href=""><img src="images/panier.png" height="50" width="50"></a>
	<p id="num"><?php echo $panier->compterpanier()?></p>
	<a  id="compte" href="accueilconnexion.php">Compte</a>
	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="TD_5.html">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="#">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher" name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /></li>
				</form>
			</ul>
		</div>
	</nav>

		<div align="center">
			<h2> Connexion à l'espace client </h2>
			<br /> <br/> 

			<!-- Identification -->


			<form method="POST" action ="">
	
				<!-- pour le login -->
				<label for "loginco">Login :</label>	
				<input type="email" placeholder="votre email" name="loginco"  value="<?php if(isset($login)) {echo $login;} ?>" />
					
				<!-- pour le mdp -->
				<label for "mdp1co">Mot de passe  :</label>			
				<input type="password" placeholder="votre MDP" name="mdp1co">
				<br/><br/>

				<input type="submit" name="connexion" value="Se connecter">
				<br/><br/>
				<p> Si vous avez pas de compte <a href="inscription.php"> S'inscrire </a> <p>
				

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