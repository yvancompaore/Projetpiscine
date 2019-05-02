<?php
session_start();
////integration initialisatio bd

require 'db.class.php';
require 'panier.class.php';
$bdd= new DB();
$panier = new panier($bdd);
$toutproduits=$bdd->requette("SELECT * FROM produits");


?>