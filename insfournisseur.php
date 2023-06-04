<?php
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

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $codeF = $_POST["codeF"];
    $nomF = $_POST["nomF"];
    $preF = $_POST["preF"];
    $numtelef = $_POST["numtelef"];
    $numfax = $_POST["numfax"];
    $villeF = $_POST["villeF"];
    $rueF = $_POST["rueF"];
    $numcompteF = $_POST["numcompteF"];
    $codePF = $_POST["codePF"];
    $numRCF = $_POST["numRCF"];
    $email = $_POST["email"];
    $password = $_POST["motepass"];
    // Requête d'insertion dans la base de données
    $requete = "INSERT INTO fournisseur (codeF,nomF,preF,numtelef,numfax,villeF,rueF ,numcompteF,codePF,numRCF,email,motepass) 
     VALUES ('$codeF','$nomF','$preF','$numtelef','$numfax','$villeF','$rueF','$numcompteF','$codePF','$numRCF','$email','$password')";
    
    if (mysqli_query($connexion, $requete)) {
        echo "L'inscription a été enregistrée avec succès.attendez la confirmation par l'admin";
    } else {
        echo "Erreur leur de l'enregistrement de l'inscription : " . mysqli_error($connexion);
    }
    // Requête pour récupérer les données de la table bon_commande
$requete = "SELECT * FROM  fournisseur ";
$resultat = mysqli_query($connexion, $requete);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
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
                <p class="par"><h2>Bienvenue sur notre plateforme 
                    d'inscription pour les fournisseurs !</h2><br>
                <h3>Nous sommes impatients de collaborer avec vous et <br>
                de construire une relation fructueuse en tant que fournisseur. <br>
                Merci de votre intérêt pour notre entreprise et <br>
                de votre confiance en nos services.<br>
                L'équipe d'inscription.</h3></p>

                <div class="form">
                   
                        <h2>Inscrivez vous ici</h2>
                        <form action="insfournisseur.php" method="POST">
                        <input type="codeF" name="codeF" placeholder="Saisissez votre Code" required>
                        <input type="nomF" name="nomF" placeholder="Saisissez votre Nom" required>
                        <input type="preF" name="preF" placeholder="Saisissez votre Prenom" required>
                        <input type="numtelef" name="numtelef" placeholder="Saisissez votre Numero telephone " required>
                        <input type="numfax" name="numfax" placeholder="Saisissez votre Numero fax " required>
                        <input type="villeF" name="villeF" placeholder="Saisissez votre Ville " required>
                        <input type="rueF" name="rueF" placeholder="Saisissez votre Rue" required>
                        <input type="codePF" name="codePF" placeholder="Saisissez votre code postale" required>
                        <input type="numcompteF" name="numcompteF" placeholder="Saisissez votre Numero compte" required>
                        <input type="numRCF" name="numRCF" placeholder="Saisissez votre Numero registre" required>
                        <input type="email" name="email" placeholder="Saisissez votre adresse e-mail" required>
                        <input type="password" name="password" placeholder="Saisissez votre mot de passe" required>
                         <button type="submit" class="btnn">inscription</button>
                        </form>
                         
                    


                </div>
            </div>
                    <footer>
                        <p>Tous droits réservés &copy; 2023 Hôtel Seybouse International annaba </p>
                    </footer>
</body>
</html>