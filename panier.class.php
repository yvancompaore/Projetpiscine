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

				if(!isset($_SESSION['panier'])){
					//creation d'un tableau de panier pour stocker les id des articles a ajouter
					$_SESSION['panier']=array();
				}

				$this->bdd=$bdd;
			}	

		//fonction pour rajouter un objet dans le panier par son id
		public function ajouter($produit_id)
		{
			//on verifie si le produit existe pas dans le panier et on augmente la quantite
			if(isset($_SESSION['panier'][$produit_id]))
			{


				$_SESSION['panier'][$produit_id]++;

			}
			else
			{
				$_SESSION['panier'][$produit_id]=1;
			}
		}

		//fonction pour supprimer 

		public function supprimer($produit_id)
		{

			unset($_SESSION['panier'][$produit_id]);
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



	}	




?>