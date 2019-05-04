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
				var_dump($_SESSION['prixto']);
				
			}
			else
			{
				
				$_SESSION[$nompanier][$produit_id]=1;
				$_SESSION['prixto']=$_SESSION['prixto']+$prix;
				var_dump($_SESSION['prixto']);
				
				
				
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
			var_dump($_SESSION['prixto']);
			unset($_SESSION[$nompanier][$produit_id]);

		}


		public function vider()
		{
			unset($_SESSION['paniermusic']);
			unset($_SESSION['panierlivre']);
			unset($_SESSION['paniervetement']);
			unset($_SESSION['paniersport']);
			unset($_SESSION['panier']);
			$_SESSION['nombrearticle']=0;
			$_SESSION['prixto']=0;
			header('Location: accueil.php');
			



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
				echo "panier vide";

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
					echo 'vous avez pas de ' .$local. ' Voulez vous en rajouter';

				}

				else{
				//recuperer les produits ajouter au paravant
				
				$produits=$this->bdd->requette('SELECT * FROM ' .$local. ' WHERE id IN ('.implode(',',$idc).')');


				
				foreach ($produits as  $produit): 
					{
						
				?>
						
							<tr>
								<?php

										
									if($local == "musique" or $local =="livre" )
									{ 
								?>
									
										<td align="right">
											<!-- pour le nom -->
										<label for "titre"> <?php echo $produit->titre ?> </label>
										</td>
								<?php
									}
								?>

								<?php
									if($local=="vetement")
									{
								?>

										<td align="right">
										<!-- pour le nom -->
										<label for "titre"> <?php echo $produit->type ?> </label>
										</td>
								<?php		
									}
								?>


								<?php
									if($local=="sport")
									{
								?>

										<td align="right">
										<!-- pour le nom -->
										<label for "titre"> <?php echo $produit->accesoire ?> </label>
										</td>
								<?php		
									}
								?>


									<td align="right">
										<label for "Prix"> <?php echo number_format($produit->prix,2,',','')?> $</label>
									</td>

									<td align="right">
										<label for "Prixtva"> Prix tva <?php echo number_format($produit->prix*1.196,2,',','')?> $</label>
									</td>

									<td align="right">

										<label for "quantite"> <?php echo $_SESSION[$nompanier][$produit->id] ?> </label>		
									</td>

									<td align="right">
										<a href="panier.php?supp=<?php echo $produit->id ?>&amp;nom=<?php echo $nompanier ?>&amp;pri=<?php echo $produit->prix ?>" > supprimer </a>
									</td>


							</tr>

					<?php
					
						}
						endforeach;
							


				  } 

				}
				


		 }


	}	




?>