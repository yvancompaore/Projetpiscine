<?php
session_start();

require 'db.class.php';
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



<!DOCTYPE html>
<html>

	<head>
		<title> INSCRIPTION </title>
	</head>


	<body>
		<div align="center">
			<h2> Connexion </h2>
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