<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=eceshop', 'root', '');



      $pseudo = isset($_POST["pseudo"])?$_POST["pseudo"]:"";
      $mail = isset($_POST["mail"])?$_POST["mail"]:"";
if(isset($_POST['connexionvendeur']))
{
   if($pseudo!="" AND $mail!="") 
   {
      $r = $bdd->prepare("SELECT nom,id FROM vendeurs WHERE pseudo = ? AND mail = ?");
      $r->execute(array($pseudo, $mail));
      $existence = $r->rowCount();
      if($existence == 1) {
         $vendeur = $r->fetch();
         $_SESSION['id'] = $vendeur['id'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "le pseudo ou le mot de passe sont incorrect";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés";
   }
}
   

?>
<html>
   <head>
      <title>Vendre</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Se connecter &agrave l'espace vendeur</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="text" name="pseudo" placeholder="Pseudo" />
            <input type="email" name="mail" placeholder="Mail" />
            <br /><br />
            <input type="submit" name="connexionvendeur" value="Connexion" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>