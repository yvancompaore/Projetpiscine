<?php
session_start();


$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');

$r = $bdd->prepare("SELECT * FROM vendeurs WHERE id=?");
$r->execute(array($_SESSION['id']));

$vendeur = $r->fetch();
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
	

	<title><?php echo $vendeur['nom']; ?></title>
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
				$('#music').css('display','none');
				$('#clothes').css('display','none');
				$('#sport').css('display','none');
			});
			$('#buttonB').click(function()
			{
				$('#items').css('display','none');
				$('#book').css('display','block');
				$('#music').css('display','none');
				$('#clothes').css('display','none');
				$('#sport').css('display','none');
			});
			
			$('#buttonM').click(function(){

				$('#items').css('display','none');
				$('#book').css('display','none');
				$('#music').css('display','block');
				$('#clothes').css('display','none');
				$('#sport').css('display','none');
			});
			
			$('#buttonC').click(function (){

				$('#items').css('display','none');
				$('#book').css('display','none');
				$('#music').css('display','none');
				$('#clothes').css('display','block');
				$('#sport').css('display','none');
			});

			$('#buttonS').click(function (){
				$('#items').css('display','none');
				$('#book').css('display','none');
				$('#music').css('display','none');
				$('#clothes').css('display','none');
				$('#sport').css('display','block');
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

	
		<div id="presentation">
			<h2>Profil de <?php echo $vendeur['pseudo']; ?></h2>
		<table>
		<tr><td><img  src="images/<?php echo $vendeur['image']; ?>" align="left" width="100" height="100"/></td>
		<td><p>Bienvenue <?php echo $vendeur['prenom']; ?> <?php echo $vendeur['nom']; ?></p><br><?php echo $vendeur['mail']; ?></td>
		</tr>
		</table>
		</div>
			
			
			 

			 
		
     <div id="container">
         <button id="visualisation">Vos items</button>
         <button id="buttonB" ">Ajouter un livre</button>
		<button id="buttonM" ">Ajouter une musique</button>
		<button id="buttonC" >Ajouter un vetement</button>
		<button id="buttonS" ">Ajouter un article sport</button>
		<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a>

		<div id=book class="ajout">
			
			<form method="POST" action="">
            	<input type="text" name="titre" placeholder="titre" />
            	<input type="text" name="auteur" placeholder="auteur" />
            	<input type="text" name="editeur" placeholder="editeur" />
            	<input type="text" name="prix" placeholder="prix" />
            	<input type="text" name="couverture" placeholder="couverture" />
            	<input type="submit" name="sendbook" value="vendre" />
            </form>	
            <?php

          	if(isset($_POST['sendbook']))
          	{
          		$titre = isset($_POST["titre"])?$_POST["titre"]:"";
      		$auteur = isset($_POST["auteur"])?$_POST["auteur"]:"";
      		$editeur = isset($_POST["editeur"])?$_POST["editeur"]:"";
      		$vendu = $vendeur["id"];
      		$prix = isset($_POST["prix"])?$_POST["prix"]:"";
      		$couverture=isset($_POST["couverture"])?$_POST["couverture"]:"";

			$req = $bdd->prepare('INSERT INTO livre(titre, auteur,editeur,vendeur_id, prix, couverture) VALUES(?,?,?,?,?,?)');
			$req->execute(array($titre,$auteur,$editeur,$vendu,$prix,$couverture));
          	}
          	
			?>   

         
 
     	</div>
         
    <div id=music class="ajout">
    	<form method="POST" action="">
            	<input type="text" name="titremusic" placeholder="titre" />
            	<input type="text" name="groupe" placeholder="groupe" />
            	<input type="text" name="album" placeholder="album" />
            	<input type="text" name="prix" placeholder="prix" />
            	<input type="text" name="pochette" placeholder="pochette" />
            	<input type="submit" name="sendmusic" value="vendre" />
         <?php

          	if(isset($_POST['sendmusic']))
          	{
          	$titrem = isset($_POST["titremusic"])?$_POST["titremusic"]:"";
      		$groupe = isset($_POST["groupe"])?$_POST["groupe"]:"";
      		$album = isset($_POST["album"])?$_POST["album"]:"";
      		$vendu = $vendeur["id"];
      		$prix = isset($_POST["prix"])?$_POST["prix"]:"";
      		$pochette=isset($_POST["pochette"])?$_POST["pochette"]:"";

			$req = $bdd->prepare('INSERT INTO musique(titre, groupe,album,vendeur_id, prix, pochette) VALUES(?,?,?,?,?,?)');
			$req->execute(array($titrem,$groupe,$album,$vendu,$prix,$pochette));	
          	}
          	
			?> 


         </form>
     </div>
    <div id=clothes class="ajout">
    	<form method="POST" action="">
            	<input type="text" name="type" placeholder="type" />
            	<input type="text" name="genre" placeholder="genre" />
            	<input type="text" name="couleur" placeholder="couleur" />
            	<input type="text" name="taille" placeholder="taille" />
            	<input type="text" name="prix" placeholder="prix" />
            	<input type="text" name="photo" placeholder="photo" />
            	<input type="submit" name="sendclothes" value="vendre" />
         </form>
         <?php

          	if(isset($_POST['sendclothes']))
          	{
          	$type = isset($_POST["type"])?$_POST["type"]:"";
      		$genre = isset($_POST["genre"])?$_POST["genre"]:"";
      		$couleur = isset($_POST["couleur"])?$_POST["couleur"]:"";
      		$vendu = $vendeur["id"];
      		$taille = isset($_POST["taille"])?$_POST["taille"]:"";
      		$prix=isset($_POST["prix"])?$_POST["prix"]:"";
      		$photo=isset($_POST["photo"])?$_POST["photo"]:"";
      		

			$req = $bdd->prepare('INSERT INTO vetement(type,genre,couleur, taille,vendeur_id,prix, photo) VALUES(?,?,?,?,?,?,?)');
			$req->execute(array($type,$genre,$couleur,$taille,$vendu,$prix,$photo));	
          	}
          	
		?>



     </div>
     <div id=sport class="ajout">
    	<form method="POST" action="">
    			<input type="sport" name="sport" placeholder="sport" />
            	<input type="text" name="accesoire" placeholder="accesoire" />
            	<input type="text" name="prix" placeholder="prix" />
            	<input type="text" name="photo" placeholder="photo" />
            	<input type="submit" name="sendsport" value="vendre" />
            	
         </form>
         <?php

          	if(isset($_POST['sendsport']))
          	{
          	$sport = isset($_POST["sport"])?$_POST["sport"]:"";
      		$accesoire = isset($_POST["accesoire"])?$_POST["accesoire"]:"";
      		$vendu = $vendeur["id"];
      		$prix=isset($_POST["prix"])?$_POST["prix"]:"";
      		$photo=isset($_POST["photo"])?$_POST["photo"]:"";
      		

			$req = $bdd->prepare('INSERT INTO sport(sport,accesoire,vendeur_id,prix, photo) VALUES(?,?,?,?,?)');
			$req->execute(array($sport,$accesoire,$vendu,$prix,$photo));	
          	}
          	
		?>
     </div>
    </div> 
     <div class="ajout" id="items">
     	
     	<h3>Musique</h3>
     	<?php
     	$requestm = $bdd->prepare("SELECT * FROM musique WHERE vendeur_id=?");
		$requestm->execute(array($vendeur["id"]));
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
		echo'<a href="profil.php?idm='.$d_IDm.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo'</tr>';
		echo '</table>';
		?>


		<h3>Livre</h3>

		<?php
     	$requestl = $bdd->prepare("SELECT * FROM livre WHERE vendeur_id=?");
		$requestl->execute(array($vendeur["id"]));

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
		echo '<a href="profil.php?idl='.$d_IDl.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo '</tr>';
		echo '</table>';
		?>

		<h3>Vetement</h3>
		<?php
		$requestv = $bdd->prepare("SELECT * FROM vetement WHERE vendeur_id=?");
		$requestv->execute(array($vendeur["id"]));

		
		echo '<table>';
		echo '<tr>';
		while ($datav = $requestv->fetch())
		{
		echo'<td id="itemvendu">';
		$d_IDv=$datav["id"];	
		echo'<img  id="imageitem" src="images/'.$datav["photo"].'"width="100" height="100"><br>';
		echo $datav["type"].'<br>';
		echo $datav["genre"].'<br>';
		echo $datav["couleur"].'<br>';
		echo $datav["taille"].'<br>';
		echo $datav["prix"].'€<br>';
		echo '<a href="profil.php?idv='.$d_IDv.'"><button class="image_supprimer"></button></a>';
		echo'</td>';
		}
		echo '</tr>';
		echo '</table>';
		?>


		<h3>Sport</h3>
		<?php
		$requests = $bdd->prepare("SELECT * FROM sport WHERE vendeur_id=?");
		$requests->execute(array($vendeur["id"]));

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
		echo '<a href="profil.php?ids='.$d_IDs.'"><button class="image_supprimer"></button></a>';
		echo'</td>';

		}
		echo'</tr>';
		echo '</table>';
		
		?>
     	

     

     </div>
 </body>
</html>


      
