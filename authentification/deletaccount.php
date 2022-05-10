<?php require('header.php');
 if( $_SESSION["connecte"] === true){?>
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
    <body>
    <?php 
    require('../cobdd.php');
    session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $username = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "pwd");
    $maRequete1 = $pdo->prepare("SELECT * FROM log WHERE username = :username ");
    $maRequete1->execute([
        ":username" => $username
    ]);
    $maRequete1->setFetchMode(PDO::FETCH_ASSOC);
    $log = $maRequete1->fetch();

if ($log['username'] == $username && $log['pwd'] == $pwd && $username == $_SESSION["username"]){
    $maRequete = $pdo->prepare("DELETE FROM log WHERE username = :username");
    $maRequete->execute([
        ":username" => $username
    ]);
    header('Location: index.php');
}elseif($log['username'] != $username or $log['pwd'] != $pwd or $username !=$_SESSION["username"]){
if($log['username'] != $username or $username !=$_SESSION["username"]){
    echo "<h2 style='color:red'> identifiant incorrect </h2>";
}elseif($log['pwd'] != $pwd){
    echo "<h2 style='color:red'> mot de passe incorrecte </h2>";
}
}
}
?>

    <h1>Supression de compte</h1>
    <p>pour supprimer votre compte veuillez renseigner de nouveau vos identifiants</p>
    <form method="post">
    <label for="">Identifiant :</label><br>
    <input type="text" name="username" required="required"><br><br>
    <label for="">Mot de passe :</label><br>
    <input type="password" name="pwd" required="required"><br><br>
    <button onclick="confirmation()" type="submit">Valider</button>
</form>
<form action="dashboard.php"><button type="submit">ANNULER</button></form>

<script>function confirmation(){alert('êtes vous sûre ? cette action est irreversible');}</script>
</body>
</html>
<?php }else{header('Location: index.php');}?>
