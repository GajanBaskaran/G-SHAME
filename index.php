<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>paint</title>
    <link rel="stylesheet" href="css/style.css">
    <img id="logo" src="css/icon/logo.png">
</head>
<div class="login">
<?php
session_start();
require('cobdd.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "pwd");
    $maRequete = $pdo->prepare("SELECT * FROM log WHERE username = :username ");
    $maRequete->execute([
        ":username" => $username
    ]);
    $maRequete->setFetchMode(PDO::FETCH_ASSOC);
    $log = $maRequete->fetch();
    if ($log['username'] == $username && $log['pwd'] == $pwd ){
            $_SESSION["connecte"] = true;
            $_SESSION["username"] = $username;
            http_response_code(302);
            header('Location: dashboard.php');
            exit();
    }elseif($log['username'] != $username or $log['pwd'] != $pwd){
        if($log['username'] != $username){
            echo "<h2 style='color:red'>identifiant indisponible, veuillez crée un compte <a href='authentification/creataccount.php'>ici</a></h2> ";
        }else{
            echo "<h2 style='color:red'>votre mot de passe à bien été mis à jour, veuillez vous connecter <a href='index.php'>ici</a></h2> ";
        }
    }
}else{
?>
<body>
<h1>BIENVENU SUR PAINT</h1>
<h2>Pour accéder au logiciel,<br> veuillez vous connecter</h2>
<form method="post">
    <label for="">Identifiant :</label><br>
    <input type="text" name="username" required="required"><br>
    <label for="">Mot de passe :</label><br>
    <input type="password" name="pwd" required="required"><br>
    <button type="submit">Valider</button>
</form>
<br>
<a href="mdpoublie.php">Mot de passe oublié ?</a>
 | <a href="ajout_compte.php">Pas encore de compte ?</a> 
</body>
<?php } ?>
</div>