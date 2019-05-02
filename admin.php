<?php
session_start();

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
   </head>
   <body>
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