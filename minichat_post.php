<?php
	session_start();
	setcookie('pseudo_minichat', $_POST["pseudo"], time() + 600); 
?>

<!DOCTYPEhtml>
<?php
 
try{
    $bdd=new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','');
}
catch (Exception $e)
{
   die('erreur:'.$e->getMessage());
}
 if(($_POST["pseudo"]) && ($_POST["message"]))
 {
//insertion req SQL
 	$pseudo = htmlspecialchars($_POST['pseudo']);
 	$message = htmlspecialchars($_POST['message']);
	$req=$bdd->prepare('INSERT INTO minichat(pseudo,message,datemessage)VALUE(:pseudo,:message, NOW())');
	$req->execute(array(
	'pseudo' => $pseudo,
	'message' => $message));
}	
 
// redirection mini chat

header('Location:minichat.php');
 
?>
