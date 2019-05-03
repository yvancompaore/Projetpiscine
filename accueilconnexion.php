<?php

require '_header.php';

$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');


if(empty($_SESSION['id']))
echo '<head>
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
	<p id="num">'.$panier->compterpanier().'</p>
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

	<div id="accueilconnexion">
		<h3 id="connexion">Connexion </h3>
		<table style="margin:30px">
			<tr><td><a href="admin.php"><img src="images/admin1.png" height="100" width="200" /></a></td></tr>
			<tr><td><a href="vendre.php"><img src="images/vendeur.png"height="100" width="200"/></a></td></tr>
			<tr><td><a   href="connexion.php"><img src="images/client.png"height="100" width="200"/></a></td></tr>
		</table>	
        	
	</div>
</div>
	

</body>
</html>';
if(!empty($_SESSION['id']))
{
	header("Location: compte.php?id=".$_SESSION['id']);
}


?>