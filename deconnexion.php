<?php 
session_start();
session_destroy();

if(isset($_SESSION["id"]) && !empty($_SESSION["id"])){
    $utilisateurConnecte = true;
    $pageTexte = "Déconnexion en cours.";
}
else{
    $utilisateurConnecte = false;
    $pageTexte = "Aucun utilisateur connecté.";
}

// redirection vers la page d'accueil
header('Location: accueil.php');

?>
<html>
    <head>
        <title>Déconnexion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="deconnexion-body">
        <h1><?php echo $pageTexte; ?></h1>
        <h1>Cliquez ici pour allez vers la page d'accueil: </h1>
        <h1><a href="accueil.php">page d'accueil</a></h1>
    </body>
</html>

