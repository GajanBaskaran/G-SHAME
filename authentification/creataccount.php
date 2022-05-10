<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>paint</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<div class="login">
    <body>
<?php     

require('../cobdd.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username");
    $username = str_replace(' ', '_', $username);
    $maRequete2 = $pdo->prepare("SELECT username FROM log WHERE username = :username");
    $maRequete2->execute(['username' => $username]);
    $verifuse = $maRequete2->fetch(); 
    if (!$verifuse){
    $pwd = filter_input(INPUT_POST, "pwd");
    $maRequete = $pdo->prepare("INSERT INTO log (username,pwd) VALUES(:username,:pwd)");
    $maRequete->execute(array(
        'username' => $username,
        'pwd' => $pwd
    ));
    mkdir('data/'.$username.'');
    header('Location: index.php');
    }elseif($verifuse){
        echo "<h2 style='color:red'>Ce nom d'utilisateur existe déjà,<br> veuillez en choisir un autre.</h2>";
    }
}
?>

    

<h1>BIENVENU SUR PAINT</h1>

<h2>Pour accéder au logiciel <br>veuillez créer un compte :</h2>
<form method="post">
    <label for="">Identifiant :</label>
    <input type="text" name="username" required="required"><br>
    <label for="">Mot de passe :</label>
    <input type="password" name="pwd" required="required"><br>
    <button type="submit">Valider</button>
</form>
<br><a href="index.php">Vous avez déjà un compte ?</a>
 
</body>
