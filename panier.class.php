<?php

	class panier
	{
		private $bdd;
		public function __construct($bdd)
			{
				//on verifier que la session a deja été ouverte sinon on louvre
				if(!isset($_SESSION))
				{
					session_start();
					
				}

				if(!isset($_SESSION['panier']) ){
					//creation d'un tableau de panier pour stocker les id des articles a ajouter
					$_SESSION['panier']=array();
					
				}

				if(!isset($_SESSION['paniermusic']))
				{

					$_SESSION['paniermusic']=array();
				}

				if(!isset($_SESSION['panierlivre']))
				{

					$_SESSION['panierlivre']=array();
				}

				if(!isset($_SESSION['paniervetement']))
				{

					$_SESSION['paniervetement']=array();
				}
				if(!isset($_SESSION['paniersport']))
				{

					$_SESSION['paniersport']=array();
				}

				if(!isset($_SESSION['nombrearticle']))
				{
					$_SESSION['nombrearticle']=0;
					
				}

				if(!isset($_SESSION['prixto']) ){
					//creation d'un tableau de panier pour stocker les id des articles a ajouter
					$_SESSION['prixto']=0;
					
				}
				$this->bdd=$bdd;
			}	

		//fonction pour rajouter un objet dans le panier par son id
		public function ajouter($produit_id,$nompanier,$prix)
		{
			//on verifie si le produit existe pas dans le panier et on augmente la quantite
			if(isset($_SESSION[$nompanier][$produit_id]))
			{
				

				$_SESSION[$nompanier][$produit_id]++;
				$_SESSION['prixto']=$_SESSION['prixto']+$prix;
				//var_dump($_SESSION['prixto']);
				
			}
			else
			{
				
				$_SESSION[$nompanier][$produit_id]=1;
				$_SESSION['prixto']=$_SESSION['prixto']+$prix;
				//var_dump($_SESSION['prixto']);
				
				
				
			}

				//gerer le nombre d'article
				$_SESSION['nombrearticle']++;
				//echo "nombrearticle";
				//var_dump($_SESSION['nombrearticle']);
		}

		

		//fonction pour supprimer 

		public function supprimer($produit_id,$nompanier,$prix)
		{
			//on actualise le nombre total puis on supprime du panier
			$_SESSION['nombrearticle']= $_SESSION['nombrearticle'] - $_SESSION[$nompanier][$produit_id];
			$_SESSION['prixto']=$_SESSION['prixto']- $prix*$_SESSION[$nompanier][$produit_id];
			//var_dump($_SESSION['prixto']);
			unset($_SESSION[$nompanier][$produit_id]);

		}

		//fonction calcul prix total
		 public function total()
		 {
		 	$total= 0;

		 	//recuper id du tableau
			$idc=array_keys($_SESSION['panier']);
			$implo=implode(',',$idc);

			if (empty($implo))
			{
				

			}

			else
			{
				//recuperer les produits ajouter au paravant
				$produits=$this->bdd->requette('SELECT * FROM produits WHERE id IN ('.implode(',',$idc).')');

				


			 	foreach ($produits as  $produit)
			 		{
			 			$total += $produit->prix* $_SESSION['panier'][$produit->id];


			 			
			 		}

				 return $total;


			 	
			  } 
			

		 }

		 //somme d'element panier
		 public function compterpanier()
		 {

		 	return array_sum($_SESSION['panier']);
		 }


		 public function afficher($nompanier,$local)
		 {


			//recuper tous les id contenus dans paniermusic
			if(isset($_SESSION[$nompanier]));
			{
				$idc=array_keys($_SESSION[$nompanier]);
				//on les separes
				$implo=implode(',',$idc);
				

				//si il y a rien dans se panier 
				if (empty($implo))
				{
					?>
					<br/>
					<?php

				}

				else{
				//recuperer les produits ajouter au paravant
				
				$produits=$this->bdd->requette('SELECT * FROM ' .$local. ' WHERE id IN ('.implode(',',$idc).')');


				
				foreach ($produits as  $produit): 
					{
						
				?>
						
							
								<?php

										
									if($local == "musique" or $local =="livre" )
									{ 
								?>
									
										
											<!-- pour le nom -->
									     	<?php
									     	$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');
									     	$requestm = $bdd->prepare("SELECT * FROM musique WHERE id=?");
											$requestm->execute(array($produit->id));
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
											echo'</td>';
											}
											echo'</tr>';
											echo '</table>';
											$requestl = $bdd->prepare("SELECT * FROM livre WHERE id=?");
												$requestl->execute(array($produit->id));

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
												echo'</td>';
												}
												echo '</tr>';
												echo '</table>';



											?>

										
								<?php
									}
								?>

								<?php
									if($local=="vetement")
									{
								?>

										
										<!-- pour le nom -->
										
											<?php
											$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');
											$requestv = $bdd->prepare("SELECT * FROM vetement WHERE id=?");
											$requestv->execute(array($produit->id));

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
											echo'</td>';
											}
											echo '</tr>';
											echo '</table>';
											?>
										
								<?php		
									}
								?>


								<?php
									if($local=="sport")
									{
										$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');
										$requests = $bdd->prepare("SELECT * FROM sport WHERE id=?");
										$requests->execute(array($produit->id));

										echo '<table>';
										echo '<tr>';
										while ($datas = $requests->fetch())
										{
										echo'<td id="itemvendu">';
										$d_IDs=$datas["id"];
										echo'<img id="imageitem" src="images/'.$datas["photo"].'"width="100" height="100"><br>';
										echo$datas["sport"].'<br>';
										echo$datas["accesoire"].'<br>';
										echo'</td>';

										}
										echo'</tr>';
										echo '</table>';

										
										
									}
								?>


									<td align="right">
										<label for "Prix"> Prix: <?php echo number_format($produit->prix,2,',','')?> $</label><br>
									</td>

									<td align="right">
										<!--<label for "Prixtva"> frais de transport (+2,00$) <?php //echo number_format($produit->prix+2,2,',','')?> €</label><br>-->
									</td>

									<td align="right">

										<label for "quantite">Quantité <?php echo $_SESSION[$nompanier][$produit->id] ?> </label>		
									</td>

									<td align="right">
										<a href="panier.php?supp=<?php echo $produit->id ?>&amp;nom=<?php echo $nompanier ?>&amp;pri=<?php echo $produit->prix ?>" ><button class="image_supprimer"></button></a>
									</td>


								

					<?php
					
						}
						endforeach;
							


				  } 

				}
				


		 }


	}	




?>