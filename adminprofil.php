<?php
require '_header.php';


$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');

$r = $bdd->prepare("SELECT * FROM vendeurs WHERE id=?");
$r->execute(array($_SESSION['id']));

$admin = $r->fetch();

if(isset($_GET["idu"]))
		{
			$deletes=$bdd->prepare("DELETE FROM vendeurs WHERE id=?");
			$deletes->execute(array($_GET['idu']));
		}
if(isset($_GET["idv"]))
		{
			$deletev=$bdd->prepare("DELETE FROM vetement WHERE id=?");
			$deletev->execute(array($_GET['idv']));
		}
if(isset($_GET["idm"]))
		{
			$deletem=$bdd->prepare("DELETE FROM musique WHERE id=?");
			$deletem->execute(array($_GET['idm']));

		}
if(isset($_GET["idl"]))
		{
			$deletel=$bdd->prepare("DELETE FROM livre WHERE id=?");
			$deletel->execute(array($_GET['idl']));
		}
if(isset($_GET["ids"]))
		{
			$deletes=$bdd->prepare("DELETE FROM sport WHERE id=?");
			$deletes->execute(array($_GET['ids']));
		}

?>
<html>
<head>
	

	<title>Admin</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles.css">	

	<script type="text/javascript">

		$(document).ready(function(){
		
			$('#visualisation').click(function()
			{
				$('#items').css('display','block');
				$('#book').css('display','none');
				$('#magasin').css('display','none');
			});
			$('#buttonB').click(function()
			{
				$('#items').css('display','none');
				$('#book').css('display','block');
				$('#magasin').css('display','none');
				
			});
			$('#voirmagasin').click(function()
			{
				$('#items').css('display','none');
				$('#book').css('display','none');
				$('#magasin').css('display','block');
				
			});
			
		});
		
	</script>
	<style type="text/css">
	body
	{
		background-image: url(images/<?php echo $vendeur['imagefond']; ?>);
		background-repeat:no-repeat;
	}
	</style>

</head>
<body >


<div id="entete">
<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
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

	
		<div id="presentation">
			<h2>Profil de <?php echo $admin['pseudo']; ?></h2>
		<table>
		<tr><td><img  src="images/<?php echo $admin['image']; ?>" align="left" width="100" height="100"/></td>
		<td><p>Bienvenue dans l'espace administrateur</p><br>Monsieur <?php echo $admin['nom']; ?></td>
		</tr>
		</table>
		</div>
			
			
			 

			 
		
     <div id="container">
         <button id="visualisation">Les vendeurs</button>
         <button id="buttonB" ">Ajouter un vendeur</button>
         <button id="voirmagasin" ">Voir tous les articles</button>
		<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a>

		<div id=book class="ajout">
			
			<form method="POST" action="" enctype="multipart/form-data">
            	<input type="text" name="nom" placeholder="nom" />
            	<input type="text" name="prenom" placeholder="prenom" />
            	<input type="text" name="pseudo" placeholder="pseudo" />
            	<input type="text" name="mail" placeholder="mail" />
            	<input type="file" name="image" placeholder="image de profil" />
            	<input type="file" name="imagefond" placeholder="image de fond" />
            	<input type="submit" name="sendbook" value="Ajouter" />
            </form>	
            <?php

          	if(isset($_POST['sendbook']))
          	{
          		$nom = isset($_POST["nom"])?$_POST["nom"]:"";
      		$prenom = isset($_POST["prenom"])?$_POST["prenom"]:"";
      		$pseudo = isset($_POST["pseudo"])?$_POST["pseudo"]:"";
      		$mail = isset($_POST["mail"])?$_POST["mail"]:"";
   
      		$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

			$target_dir1 = "images/";
			$target_file1 = $target_dir1 . basename($_FILES["imagefond"]["name"]);
			$imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
			move_uploaded_file($_FILES["imagefond"]["tmp_name"], $target_file1);

			$req = $bdd->prepare('INSERT INTO vendeurs(nom, prenom,pseudo, mail, image,imagefond) VALUES(?,?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$pseudo,$mail,$_FILES["image"]["name"],$_FILES["imagefond"]["name"]));
          	}
          	
			?>   

         
 
     	</div>
         
    </div> 
     <div class="ajout" id="items">
     	
     	<h3>Vendeur</h3>
     	<?php
     	$re = $bdd->prepare("SELECT * FROM vendeurs WHERE id != ?");
		$re->execute(array($admin["id"]));
		echo '<table>';
		echo'<tr>';
		while ($datauser = $re->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDu=$datauser["id"];
		echo'<img id="imageitem" src="images/'.$datauser["image"].'"width="100" height="100"><br>';
		echo $datauser["prenom"].'<br>';
		echo $datauser["nom"].'<br>';
		echo $datauser["pseudo"].'<br>';
		echo $datauser["mail"].'<br>';
		echo'<a href="adminprofil.php?idu='.$d_IDu.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo'</tr>';
		echo '</table>';
		?>
     </div>
     <div class="ajout" id="magasin">
     	<h3>Musique</h3>
     	<?php
     	$requestm = $bdd->query("SELECT * FROM musique");
     	$reqvend=$bdd->query("SELECT * FROM vendeurs");
     	$datavendeur=$reqvend->fetch();
		echo '<table>';
		echo'<tr>';
		while ($datam = $requestm->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDm=$datam["id"];
		echo'<img id="imageitem" src="images/'.$datam["pochette"].'"width="100" height="100"><br>';
		echo $datam["titre"].'<br>';
		echo $datam["groupe"].'<br>';
		echo $datam["album"].'<br>';
		echo $datam["prix"].'€<br>';
		if($datam["vendeur_id"]==$datavendeur["id"])
		{
			echo $datavendeur["prenom"].'<br>';
		}
		echo'<a href="adminprofil.php?idm='.$d_IDm.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo'</tr>';
		echo '</table>';
		?>


		<h3>Livre</h3>

		<?php
     	$requestl = $bdd->query("SELECT * FROM livre");

		echo '<table>';
		echo'<tr>';
		while ($datal = $requestl->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDl=$datal["id"];
		echo'<img id="imageitem" src="images/'.$datal["couverture"].'"width="100" height="100"><br>';
		echo $datal["titre"].'<br>';
		echo $datal["auteur"].'<br>';
		echo $datal["editeur"].'<br>';
		echo $datal["prix"].'€<br>';
		echo '<a href="adminprofil.php?idl='.$d_IDl.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo '</tr>';
		echo '</table>';
		?>

		<h3>Vetement</h3>
		<?php
		$requestv = $bdd->query("SELECT * FROM vetement");
		
		echo '<table>';
		echo '<tr>';
		while ($datav = $requestv->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDv=$datav["id"];	
		echo'<img id="imageitem" src="images/'.$datav["photo"].'"width="100" height="100"><br>';
		echo $datav["type"].'<br>';
		echo $datav["genre"].'<br>';
		echo $datav["couleur"].'<br>';
		echo $datav["taille"].'<br>';
		echo $datav["prix"].'€<br>';
		echo '<a href="adminprofil.php?idv='.$d_IDv.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo '</tr>';
		echo '</table>';
		?>


		<h3>Sport</h3>
		<?php
		$requests = $bdd->query("SELECT * FROM sport");
		

		echo '<table>';
		echo '<tr>';
		while ($datas = $requests->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDs=$datas["id"];
		echo'<img id="imageitem" src="images/'.$datas["photo"].'"width="100" height="100"><br>';
		echo$datas["sport"].'<br>';
		echo$datas["accesoire"].'<br>';
		echo $datas["prix"].'€<br>';
		echo '<a href="adminprofil.php?ids='.$d_IDs.'"><button class="image_supprimer"></button></a>';
		echo'</td>';

		}
		echo'</tr>';
		echo '</table>';
		
		?>
     </div>
  
</div>

    
 </body>
</html>
<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>
