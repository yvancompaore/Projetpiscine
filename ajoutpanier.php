<?php

require '_header.php';

//voir si lid est bien recus
//var_dump($_GET);

if(isset($_GET['idp']))
{	
	//on recupere l'id du produit
	$produit=$bdd->requette('SELECT id FROM musique WHERE id=:id',array('id' => $_GET['idp']));
	
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
	echo "Erreur pas de produit";
}




?>