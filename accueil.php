<?php

require '_header.php';

$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');

if(isset($_SESSION['id']))
{
$req=$bdd->prepare("SELECT * FROM acheteurs WHERE id=?");
$req->execute(array($_SESSION['id']));
$client=$req->fetch();



echo '<h4 id="icone">'.$client["pseudo"].'<a href="deconnexion.php"><img src="images/deconnexion.png" with="25" height="25"/></a></h4>';


}





?>


<head>
	<title>ECESHOP</title>
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
	

	<a id ="logo" href="accueil.php"><img src="images/logo.png" height="100" width="100"></a>
	<a id ="panier" href="panier.php"><img src="images/panier.png" height="50" width="50"></a>
	<p id="num"><?php echo $_SESSION['nombrearticle']?></p>
	<a  id="compte" href="accueilconnexion.php">Compte<?php

	?></a>

	
	

	<nav class="navbar navbar-expand-md">
		
		<div class="navbar-collapse" id="main-navigation">
			
			<ul class="navbar-nav">
				<li class="Categorie"><a class="nav-link" href="accueil.php">Categorie</a></li>
				<li class="Flash"><a class="nav-link" href="#">Vente Flash</a></li>
				<form method="GET" action="trouver.php">
   				<li><input type="search" id="rechercher"name="q" placeholder="Recherche..." /></li>
   				<li><input type="submit" id="validerrecherche" value="Valider" /></li>
				</form>
			</ul>
		</div>
	</nav>


	<div id="itemsvendu">
		<br>
		<h3 id="presentationi">Musique</h3>
     	<?php
     	$requestm = $bdd->query("SELECT * FROM musique");
		
		echo '<table>';
		echo'<tr>';
		while ($datam = $requestm->fetch())
		{
		echo'<td id="itemvendu">';
		echo'<img id="imageitem" src="images/'.$datam["pochette"].'"width="100" height="100"><br>';
		echo $datam["titre"].'<br>';
		echo $datam["groupe"].'<br>';
		echo $datam["album"].'<br>';
		echo $datam["prix"].'€<br>';
		
		if(!isset($_SESSION['paniermusic'][$datam["id"]]))
		{
		echo'<a href="ajoutpanier.php?idm='.$datam["id"].'"><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		else
		{
			echo'<a ><button>Deja dans le panier</button></a>';
			echo'</td>';

		}




			
		}
		echo'</tr>';
		echo '</table>';
		?>


		<h3 id="presentationi">Livre</h3>

		<?php
     	$requestl = $bdd->query("SELECT * FROM livre ");
		

		echo '<table>';
		echo'<tr>';
		while ($datal = $requestl->fetch())
		{
		echo'<td id="itemvendu">';
		echo'<img id="imageitem" src="images/'.$datal["couverture"].'"width="100" height="100"><br>';
		echo $datal["titre"].'<br>';
		echo $datal["auteur"].'<br>';
		echo $datal["editeur"].'<br>';
		echo $datal["prix"].'€<br>';
	
		if(!isset($_SESSION['panierlivre'][$datal["id"]]))
		{
		echo'<a href="ajoutpanier.php?idl='.$datal["id"].'"><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		else
		{
			echo'<a ><button>Deja dans le panier</button></a>';
			echo'</td>';

		}


		


		}
		echo '</tr>';
		echo '</table>';
		?>

		<h3 id="presentationi">Vetement</h3>
		<?php
		$requestv = $bdd->query("SELECT * FROM vetement");

		
		echo '<table>';
		echo '<tr>';
		while ($datav = $requestv->fetch())
		{
		echo'<td id="itemvendu">';	
		echo'<img id="imageitem" src="images/'.$datav["photo"].'"width="100" height="100"><br>';
		echo $datav["type"].'<br>';
		echo $datav["genre"].'<br>';
		echo $datav["couleur"].'<br>';
		echo $datav["taille"].'<br>';
		echo $datav["prix"].'€<br>';
		

		if(!isset($_SESSION['paniervetement'][$datav["id"]]))
		{
		echo'<a href="ajoutpanier.php?idv='.$datav["id"].'"><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		else
		{
			echo'<a ><button>Deja dans le panier</button></a>';
			echo'</td>';

		}




		}
		echo '</tr>';
		echo '</table>';
		?>


		<h3 id="presentationi">Sport</h3>
		<?php
		$requests = $bdd->query("SELECT * FROM sport ");
		

		echo '<table>';
		echo '<tr>';
		while ($datas = $requests->fetch())
		{
		echo'<td id="itemvendu">';
		echo'<img id="imageitem"src="images/'.$datas["photo"].'"width="100" height="100" ><br>';
		echo$datas["sport"].'<br>';
		echo$datas["accesoire"].'<br>';
		echo $datas["prix"].'€<br>';
		
		if(!isset($_SESSION['paniersport'][$datas["id"]]))
		{
		echo'<a href="ajoutpanier.php?ids='.$datas["id"].'"><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		else
		{
			echo'<a ><button>Deja dans le panier</button></a>';
			echo'</td>';

		}

		}
		echo'</tr>';
		echo '</table>';
		
		?>

	</div>
</div>

	

</body>
<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>
</html>