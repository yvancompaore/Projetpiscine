<?php
require '_header.php';

$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');


      $pseudoadmin = isset($_POST["pseudoadmin"])?$_POST["pseudoadmin"]:"";
      $mailadmin = isset($_POST["mailadmin"])?$_POST["mailadmin"]:"";

if(isset($_POST['connexionadmin']))
{
   if($pseudoadmin!="" AND $mailadmin!="") 
   {
      $r = $bdd->prepare("SELECT * FROM vendeurs WHERE pseudo = ? AND mail = ?");
      $r->execute(array($pseudoadmin, $mailadmin));
      $admin = $r->fetch();

      if($admin["id"] == 1) 
      {
         
         $_SESSION['id'] = $admin['id'];
         header("Location: adminprofil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "le pseudo ou mail sont incorrect";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés";
   }
}
?>
<html>
   <head>
      <title>Admin</title>
      <meta charset="utf-8">
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
            <li class="Flash"><a class="nav-link" href="venteflash.php">Vente Flash</a></li>
            <form method="GET" action="trouver.php">
               <li><input type="search" id="rechercher"name="q" placeholder="Recherche..." /></li>
               <li><input type="submit" id="validerrecherche" value="Valider" /><li>
            </form>
         </ul>
      </div>
   </nav>
      <div align="center">
         <h2>Se connecter &agrave l'espace administrateur</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="text" name="pseudoadmin" placeholder="Pseudo" />
            <input type="email" name="mailadmin" placeholder="Mail" />
            <br /><br />
            <input type="submit" name="connexionadmin" value="Connexion" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>
<footer>
   Copyright &copy, ECESHOP<br> En cas de problème veuillez <a href="mailto:marc.gemayel@edu.ece.fr">contacter l'administrateur</a>
</footer>