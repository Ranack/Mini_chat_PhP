<?php
session_start();
$_SESSION['pseudo_minichat'] = $_COOKIE['pseudo_minichat'];
?>
<!DOCTYPE html>
 
<html>
    <head>
        <meta charset="utf-8">
        <title>Mini-chat PhP</title>
    </head>
     
    <style>
        form{
            text-align:center;
        }
    </style>
     
        
    <body>
         
        <form action="minichat_post.php" method="post" >
             
            <p>
             <label for="pseudo">pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="<?php echo htmlspecialchars($_SESSION["pseudo_minichat"]); ?>" required/> 
                <br />
             <label for="message">message</label>  :<input type="text" name="message" id="message"/>
                <br />
                 
             <input type="submit" value="envoyer"/>                              
                 
            </p>
     
        </form>
         
         <?php
        
        //connexion à la bdd
         
        try
        {
           $bdd=new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','');
        }
        catch (Exception $e)
        {
     
          die('erreur:'.$e->getMessage());
        }
        //----------------------------------------------------------
         
         
        //récupération des 10 derniers messages
        $reponse=$bdd->query('SELECT *, DATE_FORMAT(datemessage,"%d/%m/%Y %Hh %imin %ss") AS date_ajout FROM minichat ORDER BY ID desc');
         
        // affichage de chaque ligne + sécurité.
         
        while($donnees=$reponse->fetch())
        {
           echo '<p><strong> ' . $donnees['date_ajout'] . ' ' . htmlspecialchars($donnees['pseudo']) . ' </strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
        }


         
        $reponse->closeCursor();
         
        ?> 
    </body>
     
 
    
     
</html>