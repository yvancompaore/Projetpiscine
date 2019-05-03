<?php

require '_header.php';

//voir si lid est bien recus
//var_dump($_GET);

//si c'est une music
	if(isset($_GET['idm']))
		{	
			//on recupere l'id du produit
			$produit=$bdd->requette('SELECT id FROM musique WHERE id=:id',array('id' => $_GET['idm']));
			
			//verifie qu'il existe
			if(empty($produit))
			{
				echo "Ce Produit n'existe pas";
			}

			
			//on le rajoute dans le tableau pour panier
			$panier->ajouter($produit[0]->id,"paniermusic");
			
			die('Le produit a bien été ajouter au panier <a href="javascript:history.back()"> retour </a>');

			//header('Location: testpanier.php');

		}
	

	else
		{
			//si c'est un livre
			if(isset($_GET['idl']))
				{	
					//on recupere l'id du produit
					$produit=$bdd->requette('SELECT id FROM livre WHERE id=:id',array('id' => $_GET['idl']));
					
					//verifie qu'il existe
					if(empty($produit))
					{
						echo "Ce Produit n'existe pas";
					}

					
					//on le rajoute dans le tableau pour panier
					$panier->ajouter($produit[0]->id);
					
					die('Le produit a bien été ajouter au panier <a href="javascript:history.back()"> retour </a>');

					//header('Location: testpanier.php');

				}

			else
				{
					//si c'est un livre
					if(isset($_GET['idl']))
					{	
						//on recupere l'id du produit
						$produit=$bdd->requette('SELECT id FROM livre WHERE id=:id',array('id' => $_GET['idl']));
						
						//verifie qu'il existe
						if(empty($produit))
						{
							echo "Ce Produit n'existe pas";
						}

						
						//on le rajoute dans le tableau pour panier
						$panier->ajouter($produit[0]->id);
						
						die('Le produit a bien été ajouter au panier <a href="javascript:history.back()"> retour </a>');

						//header('Location: testpanier.php');
					}

					else
					{
						//si c'est un vetement
						if(isset($_GET['idv']))
						{	
							//on recupere l'id du produit
							$produit=$bdd->requette('SELECT id FROM vetement WHERE id=:id',array('id' => $_GET['idv']));
							
							//verifie qu'il existe
							if(empty($produit))
							{
								echo "Ce Produit n'existe pas";
							}

							
							//on le rajoute dans le tableau pour panier
							$panier->ajouter($produit[0]->id);
							
							die('Le produit a bien été ajouter au panier <a href="javascript:history.back()"> retour </a>');

							//header('Location: testpanier.php');
						}

						else
						{	
							//si c'est un sport
							if(isset($_GET['ids']))
							{	
								//on recupere l'id du produit
								$produit=$bdd->requette('SELECT id FROM sport WHERE id=:id',array('id' => $_GET['ids']));
								
								//verifie qu'il existe
								if(empty($produit))
								{
									echo "Ce Produit n'existe pas";
								}

								
								//on le rajoute dans le tableau pour panier
								$panier->ajouter($produit[0]->id);
								
								die('Le produit a bien été ajouter au panier <a href="javascript:history.back()"> retour </a>');

								//header('Location: testpanier.php');
							}

							else
							{

								die('pas darticle dans le panier');
							}


						}


					}

				}
		

		}








	





?>