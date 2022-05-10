<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>paint</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<div class="login">
<?php
require('cobdd.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "pwd");
    $maRequete = $pdo->prepare(" UPDATE log SET pwd = :pwd WHERE username = :username ");
    $maRequete->execute(array(
        'username' => $username,
        'pwd' => $pwd
    ));
    $maRequete->setFetchMode(PDO::FETCH_ASSOC);
    $log = $maRequete->fetch();
        if($log['username'] != $username){
            echo "<h2 style='color:red'>identifiant indisponible, veuillez crée un compte <a href='ajout_compte.php'>ici</a></h2> ";
        }else{
            echo "<h2 style='color:red'>votre mot de passe à bien été mis à jour, veuillez vous connecter <a href='index.php'>ici</a></h2> ";
        }
}else{
?>
<body>
<h1>BIENVENU SUR PAINT</h1>
<h2>Modifier votre mot de passe :</h2>
<form method="post">
    <label for="">Identifiant :</label>
    <input type="text" name="username" required="required"><br>
    <label for="">Mot de passe :</label>
    <input type="password" name="pwd" required="required"><br>
    <button type="submit">Valider</button>
</form>
<br>
<a href="index.php">retour</a>
</body>
<?php } ?>
</div>