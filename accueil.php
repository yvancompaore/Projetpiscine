<?php

session_start();


$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');


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
	<a  id="compte" href="accueilconnexion.php">Compte</a>
	

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


	<div id="items">

		<h3>Musique</h3>
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
		echo'<a href="ajoutpanier.php?idp='.$datam["id"].'"><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		echo'</tr>';
		echo '</table>';
		?>


		<h3>Livre</h3>

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
		echo'<a href=""><button>ajouter au panier</button></a>';
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
		echo'<img id="imageitem" src="images/'.$datav["photo"].'"width="100" height="100"><br>';
		echo $datav["type"].'<br>';
		echo $datav["genre"].'<br>';
		echo $datav["couleur"].'<br>';
		echo $datav["taille"].'<br>';
		echo $datav["prix"].'€<br>';
		echo'<a href=""><button>ajouter au panier</button></a>';
		echo'</td>';
		}
		echo '</tr>';
		echo '</table>';
		?>


		<h3>Sport</h3>
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
		echo'<a href=""><button>ajouter au panier</button></a>';
		echo'</td>';

		}
		echo'</tr>';
		echo '</table>';
		
		?>









	</div>
</div>

	

</body>
</html>