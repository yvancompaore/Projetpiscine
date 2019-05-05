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
		<p id="num"><?php echo $panier->compterpanier()?></p>
		<a  id="compte" href="accueilconnexion.php">Compte</a>
		

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

			<div id="items">
				<?php
				if(isset($_GET['q']) AND !empty($_GET['q'])) 
				{
					$q = htmlspecialchars($_GET['q']);
					$articlesm = $bdd->prepare('SELECT * FROM musique WHERE titre=? OR groupe=? OR album=? ');
					$articlesm->execute(array($_GET['q'],$_GET['q'],$_GET['q']));
					if($articlesm->rowcount()==0)
					{
						$articlesl= $bdd->prepare('SELECT * FROM livre WHERE titre=? OR auteur=? OR editeur=? ');
						$articlesl->execute(array($_GET['q'],$_GET['q'],$_GET['q']));
						if($articlesl->rowcount()==0)
						{
							$articlesv = $bdd->prepare('SELECT * FROM vetement WHERE type=? OR genre=? OR couleur=? OR taille=?');
							$articlesv->execute(array($_GET['q'],$_GET['q'],$_GET['q'],$_GET['q']));
							if($articlesv->rowcount()==0)
							{
								$articless = $bdd->prepare('SELECT * FROM sport WHERE sport=? OR accesoire=?');
								$articless->execute(array($_GET['q'],$_GET['q']));
								if($articless->rowcount()==0)
								{
									echo"<h3>non</h3>";
								}
								if($articless->rowcount()!=0)
								{
									echo '<table>';
									echo '<tr>';
									while ($datas = $articless->fetch())
									{
									echo'<td id="itemvendu">';
									echo'<img id="imageitem"src="images/'.$datas["photo"].'"width="100" height="100"><br>';
									echo$datas["sport"].'<br>';
									echo$datas["accesoire"].'<br>';
									echo $datas["prix"].'€<br>';
									echo'<a href="ajoutpanier.php?ids='.$datas["id"].'"><button>ajouter au panier</button></a>';
									echo'</td>';

									}
									echo'</tr>';
									echo '</table>';
								}

							}
							if ($articlesv->rowcount()!=0) 
							{
								echo '<table>';
								echo '<tr>';
								while ($datav = $articlesv->fetch())
								{
								echo'<td id="itemvendu">';	
								echo'<img id="imageitem" src="images/'.$datav["photo"].'"width="100" height="100"><br>';
								echo $datav["type"].'<br>';
								echo $datav["genre"].'<br>';
								echo $datav["couleur"].'<br>';
								echo $datav["taille"].'<br>';
								echo $datav["prix"].'€<br>';
								echo'<a href="ajoutpanier.php?idv='.$datav["id"].'"><button>ajouter au panier</button></a>';
								echo'</td>';
								}
								echo '</tr>';
								echo '</table>';
							}

						}
						if($articlesl->rowcount()!=0)
						{
							echo '<table>';
							echo'<tr>';
							while ($datal = $articlesl->fetch())
							{
							echo'<td id="itemvendu">';
							echo'<img id="imageitem" src="images/'.$datal["couverture"].'"width="100" height="100"><br>';
							echo $datal["titre"].'<br>';
							echo $datal["auteur"].'<br>';
							echo $datal["editeur"].'<br>';
							echo $datal["prix"].'€<br>';
							echo'<a href="ajoutpanier.php?idl='.$datal["id"].'"><button>ajouter au panier</button></a>';
							echo'</td>';
							}
							echo '</tr>';
							echo '</table>';
						}

					
					}
					if($articlesm->rowcount()!=0)
					{
						echo '<table>';
						echo'<tr>';
						while ($datam = $articlesm->fetch())
						{
						echo'<td id="itemvendu">';
						echo'<img id="imageitem" src="images/'.$datam["pochette"].'"width="100" height="100"><br>';
						echo $datam["titre"].'<br>';
						echo $datam["groupe"].'<br>';
						echo $datam["album"].'<br>';
						echo $datam["prix"].'€<br>';
						echo'<a href="ajoutpanier.php?idm='.$datam["id"].'"><button>ajouter au panier</button></a>';
						echo'</td>';
						}
						echo'</tr>';
						echo '</table>';
					}
					


				}
				?>
				
			</div>
	
				
			</body>
			<footer>
	Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>
	</html>	