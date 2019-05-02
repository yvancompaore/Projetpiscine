<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');

$r = $bdd->prepare("SELECT * FROM vendeurs WHERE id=?");
$r->execute(array($_GET['id']));

$admin = $r->fetch();
?>
<html>
<head>
	

	<title><?php echo $admin['nom']; ?></title>
	<meta charset="utf-8">
	<link href="deco.css" rel="stylesheet" type"text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
		
			$('#visualisation').click(function()
			{
				$('#items').css('display','block');
				$('#newvendeur').css('display','none');
				
			});
			$('#ajoutervendeur').click(function()
			{
				$('#items').css('display','none');
				$('#newvendeur').css('display','block');
			});
		});
		
	</script>
	<style type="text/css">
	</style>

</head>
<body style="background-image: url(images/<?php echo $admin['imagefond']; ?>)">
	<h2>Profil de <?php echo $admin['pseudo']; ?></h2>
	<img  src="images/<?php echo $admin['image']; ?>" align="left" width="100" height="100"/>
	
     <div id="container">
         <p>Bienvenue <?php echo $admin['prenom']; ?> <?php echo $admin['nom']; ?></p>
         <br />
         <?php echo $admin['mail']; ?>
         <br />
         <button id="visualisation">Vendeurs</button>
         <button id="ajoutervendeur" ">Ajouter un vendeur</button>
		<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a>

		<div id="newvendeur" class="ajout">
			
			<form method="POST" action="">
            	<input type="text" name="nom" placeholder="Nom" />
            	<input type="text" name="prenom" placeholder="Prenom" />
            	<input type="text" name="pseudo" placeholder="Pseudo" />
            	<input type="email" name="mail" placeholder="Mail" />
            	<input type="text" name="image" placeholder="Photo de Profil" />
            	<input type="text" name="imagefond" placeholder="Image de fond" />
            	<input type="submit" name="createnewvendeur" value="vendre" />
            </form>	
            <?php

          	if(isset($_POST['createnewvendeur']))
          	{
          		$nom = isset($_POST["nom"])?$_POST["nom"]:"";
      		$prenom = isset($_POST["prenom"])?$_POST["prenom"]:"";
      		$pseudo= isset($_POST["pseudo"])?$_POST["pseudo"]:"";
      		$mail = isset($_POST["mail"])?$_POST["mail"]:"";
      		$image=isset($_POST["image"])?$_POST["image"]:"";
      		$imagefond=isset($_POST["imagefond"])?$_POST["imagefond"]:"";
			$req = $bdd->prepare('INSERT INTO vendeurs(nom, prenom,pseudo,mail,image, imagefond) VALUES(?,?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$pseudo,$mail,$image,$imagefond));
          	}
          	
			?>   

         
 
     	</div>
     
     </div>
     <div class="ajout" id="items">
     	<h3>Tous les vendeurs</h3>
     	<?php
     	$all = $bdd->query("SELECT * FROM vendeurs");
		echo '<ul>';
		while ($datavendeur = $all->fetch())
		{
		$d_ID=$datavendeur["id"];
		
		echo'<li>'.$datavendeur["nom"].' '.$datavendeur["prenom"].' '.$datavendeur["pseudo"].' '.$datavendeur["mail"].'<form method="POST" action=""><input class="image_supprimer_input" type="submit" name="supprimer" value="" /></form>';
		}
		echo '</table>';
		if(isset($_POST['supprimer']))
		{
			$deletem=$bdd->prepare("DELETE FROM vendeurs WHERE id=?");
			$deletem->execute(array($d_ID));

		}

		?>
		</div>
	
 </body>
</html>