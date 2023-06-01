<?php
// Vérifie si le bouton de déconnexion a été cliqué
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
        // header("Location: controleur.php");
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
  header('Location: accueil.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Controleur</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <title>systeme de suivi des approvisionnements au niveau de l hotel Seybouse Annaba</title>
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
                  <li><a class="navbar-link" href="controleur.php">Acceuil</a></li>
                  <li><a class="navbar-link" href="Contacte.html">Contacte</a></li> 
                  <li><a class="navbar-link" href="a-propos.html">A propos</a></li>
                  <form action="deconnexion.php" method="POST">
                    <button class="btnd"><a href="deconnexion.php">Déconnexion</a></button>
                  </form>
                </ul>
                </div>         
</div>
          
                <div class="content"> 
              <h3>Bienvenue sur notre interface,</h3></br>
                <p class="par"> 
                cher contrôleur. Nous sommes heureux de vous accueillir ici,<br>
                 prêts à vous accompagner dans vos tâches de contrôle avec des <br>
                fonctionnalités avancées et des informations pertinentes pour garantir<br>
                 la conformité et l'intégrité des processus.</p>

                 <h3>Affichier les demandes d'achat pour controler</h3>
                 <form action="controleur.php" method="post"><div>
                       <input type="submit" name="recuperer_demandes" class="btnn" value="Récupérer les demandes"><br>
                       
                      </form>
                      <?php
        if (isset($_POST['recuperer_demandes'])) {
// Configuration de la connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur de la base de données
$motDePasse = ""; // Mot de passe de la base de données
$baseDeDonnees = "hotel_bdd"; // Nom de la base de données

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion à la base de données
if (!$connexion) {
   die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}


// Requête SQL pour récupérer les demandes d'achat
$requete = "SELECT * FROM demandes_achat";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification du résultat de la requête
if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Affichage des résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "numero de la demande : " . $row['numDA'] . "<br>";
    echo "nom demande : " . $row['nom_demande'] . "<br>";
    echo "contenu de la demande : " . $row['contenu_demande'] . "<br>";
    echo "Date de la demande : " . $row['date'] . "<br>";
    // Afficher d'autres colonnes si nécessaire
    echo "<br>";
}

        }
        
              ?>
</div> 
       
                <footer>
                <p>Tous droits réservés &copy; 2023 Hôtel Seybouse International annaba </p>
                </footer>
</body>
</html>