<?php

// vérifier si l'utilisateur est déja connecté
session_start();
if(isset($_SESSION) && !empty($_SESSION)){
    $utilisateurConnecte = true;
    $typeUtilisateur = $_SESSION["user"]["type_utilisateur"];
    // Redirection en fonction du type d'utilisateur
    if ($typeUtilisateur == '1') {
        header("Location: agentstru.php");
    } 
    elseif ($typeUtilisateur == '2') {
        header("Location: chefappro.php");
    } 
    elseif ($typeUtilisateur == '3') {
        header("Location: controleur.php");
    } 
    elseif ($typeUtilisateur == '4') {
        header("Location: acheteur.php");
    } 
    elseif ($typeUtilisateur == '5') {
        header("Location: comptable.php");
    } 
    elseif ($typeUtilisateur == '6') {
        header("Location: magasinier.php");
    }
    elseif ($typeUtilisateur == '7'){
        header("Location: fournisseur.php");
    }
}
else {
    $utilisateurConnecte = false;
}

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "if server method post";
    // Configuration de la connexion à la base de données
    $serveur = "localhost"; // Adresse du serveur MySQL
    $utilisateur = "root"; // Nom d'utilisateur de la base de données
    $motDePasse = ""; // Mot de passe de la base de données
    $baseDeDonnees = "hotel_bdd"; // Nom de la base de données

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérification des erreurs de connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données: " . $connexion->connect_error);
    }

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier les informations d'identification
    $sql = "SELECT * FROM utilisateurs WHERE username='$email' AND password='$password'";
    $resultat = $connexion->query($sql);

    // Vérification si l'utilisateur existe
    if ($resultat->num_rows > 0) {
        $utilisateur = $resultat->fetch_assoc();
        session_start();
        $_SESSION["user"] = $utilisateur;
        $utilisateurConnecte = true;
        header('Location: accueil.php');
        // exit();
    } 
    else {
        // L'utilisateur n'est pas authentifié
        echo "Échec de l'authentification!";
    }

    // Fermeture de la connexion à la base de données
    $connexion->close();
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- <title>systeme de suivi des approvisionnements au niveau de l hotel Seybouse Annaba</title> -->
        <title>Hotel - Accueil</title>
   
         <link rel="stylesheet" href="style.css">
       </head>
<body>
<div class="main">
        <div class="navbar">
           <div class="icon">
             <h2 class="logo">ApproDZ</h2>
           </div>
        
              <div class="menu">
                <ul>
                <li><a class="navbar-link" href="accueil.php">Acceuil</a></li>
                <li><a class="navbar-link" href="service.html">Services</a></li>
                <li><a class="navbar-link" href="contacte.html">Contact</a></li>
                </ul>
                </div>    
           
            </div>
            <div class="content">
                <h1> Approvisionnement Hotel<br>Seybouse Annaba</br></h1> 
                <p class="par">Notre système suivi d'approvisionnement est conçu pour optimiser l'efficacité et     
                <br>la fiabilité de notre chaîne, garantissant ainsi une disponibilité constante des produits</br>
                et une satisfaction maximale des clients.</p>

                <div class="form">
                    <!-- </form> -->

                    <?php if($utilisateurConnecte){ ?>
                        <h2>Vous etes déja connecté</h2>
                        <button class="btnn"><a href="deconnexion.php">Déconnexion</a></button>
                    <?php } else { ?>
                        <h2>Connectez-vous ici</h2>
                        <form action="accueil.php" method="POST">
                            <input type="email" name="email" placeholder="Saisissez votre adresse e-mail" required>
                            <input type="password" name="password" placeholder="Saisissez votre mot de passe" required>
                            <button type="submit" class="btnn">Connexion</button>
                        </form>
                        <p class="link"></p> 
                    <?php } ?>
                    


                </div>
            </div>
                    <footer>
                        <p>Tous droits réservés &copy; 2023 Hôtel Seybouse International annaba </p>
                    </footer>
</body>
</html>