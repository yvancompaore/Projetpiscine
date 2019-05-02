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
	<link href="deco.css" rel="stylesheet" type"text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
	</style>

</head>
<body style="background-image: url(images/<?php echo $vendeur['imagefond']; ?>)">
	<h2>Profil de <?php echo $vendeur['pseudo']; ?></h2>
	<img  src="images/<?php echo $vendeur['image']; ?>" align="left" width="100" height="100"/>
	
     <div id="container">
         <p>Bienvenue <?php echo $vendeur['prenom']; ?> <?php echo $vendeur['nom']; ?></p>
         <br />
         <?php echo $vendeur['mail']; ?>
         <br />
         <button id="visualisation" onclick="newElement()">Vos items</button>
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
     	<div id="loadmusic">
     	<h3>Musique</h3>
     	<?php
     	$requestm = $bdd->prepare("SELECT * FROM musique WHERE vendeur_id=?");
		$requestm->execute(array($vendeur["id"]));
		echo '<table>';
		while ($datam = $requestm->fetch())
		{
		$d_IDm=$datam["id"];
		echo'<tr><td><img src="images/'.$datam["pochette"].'"width="50" height="50"></td>';
		echo'<td>'.$datam["titre"].'</td>';
		echo'<td>'.$datam["groupe"].'</td>';
		echo'<td>'.$datam["album"].'</td>';
		echo'<td>'.$datam["prix"].'€</td>';
		echo'</tr>';
		?>
		<a href="profil.php?idm=<?php echo $d_IDm?>"><button class="image_supprimer"></button></a>
		<?php
		}
		echo '</table>';
		?>
		</div>


		<h3>Livre</h3>

		<?php
     	$requestl = $bdd->prepare("SELECT * FROM livre WHERE vendeur_id=?");
		$requestl->execute(array($vendeur["id"]));

		echo '<table>';
		while ($datal = $requestl->fetch())
		{
		$d_IDl=$datal["id"];
		echo'<tr><td><img src="images/'.$datal["couverture"].'"width="50" height="50"></td>';
		echo'<td>'.$datal["titre"].'</td>';
		echo'<td>'.$datal["auteur"].'</td>';
		echo'<td>'.$datal["editeur"].'</td>';
		echo'<td>'.$datal["prix"].'€</td>';
		?>
		<a href="profil.php?idl=<?php echo $d_IDl?>">supprimer</a>	
		<?php

		}
		echo '</table>';
		
		?>

		<h3>Vetement</h3>
		<?php
		$requestv = $bdd->prepare("SELECT * FROM vetement WHERE vendeur_id=?");
		$requestv->execute(array($vendeur["id"]));

		
		echo '<table>';
		while ($datav = $requestv->fetch())
		{
		$d_IDv=$datav["id"];	
		echo'<tr><td><img src="images/'.$datav["photo"].'"width="50" height="50"></td>';
		echo'<td>'.$datav["type"].'</td>';
		echo'<td>'.$datav["genre"].'</td>';
		echo'<td>'.$datav["couleur"].'</td>';
		echo'<td>'.$datav["taille"].'</td>';
		echo'<td>'.$datav["prix"].'€</td>';
		?>
		<a href="profil.php?idv=<?php echo $d_IDv?>" name="supprimerv">supprimer</a>		
		<?php
		}

		echo '</table>';
		?>


		<h3>Sport</h3>
		<?php
		$requests = $bdd->prepare("SELECT * FROM sport WHERE vendeur_id=?");
		$requests->execute(array($vendeur["id"]));

		echo '<table>';
		while ($datas = $requests->fetch())
		{
		$d_IDs=$datas["id"];
		echo'<tr><td><img src="images/'.$datas["photo"].'"width="50" height="50"></td>';
		echo'<td>'.$datas["sport"].'</td>';
		echo'<td>'.$datas["accesoire"].'</td>';
		echo'<td>'.$datas["prix"].'€</td>';
		echo'</tr>';
		?>
		<a href="profil.php?ids=<?php echo $d_IDs?>">supprimer</a>
		<?php
		}
		echo '</table>';
		
		?>
     	

     

     </div>
 </body>
</html>


      
