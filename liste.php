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
                <p class="par">la liste des fournisseurs</p>

                <form action="liste.php" method="POST"><div>
                       <input type="submit" name="recuperer_liste" class="btnn" value="Récupérer liste"><br>
                       
                      </form>
     <?php
        if (isset($_POST['recuperer_liste'])) {
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

   
$requete = "SELECT * FROM  fournisseur";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification du résultat de la requête
if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Affichage des résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "code de fournisseur  : " . $row['codeF'] . "<br>";
    echo " nom de fournisseur : " . $row['nomF'] . "<br>";
    echo " prenome de fournisseur : " . $row['preF'] . "<br>";
    echo " numero de telephone  : " . $row['numtelef'] . "<br>";
    echo "numero de fax  : " . $row['numfax'] . "<br>";
    echo " ville de fournisseur : " . $row['villeF'] . "<br>";
    echo "  rue de fournisseur : " . $row['rueF'] . "<br>";
    echo "  code postale de fournisseur : " . $row['codePF'] . "<br>";
    echo "   numero : " . $row['numcompteF	'] . "<br>";
    echo "  numero de registre de fournisseur: " . $row['numRCF	'] . "<br>";
    echo "  emaile de fournisseur : " . $row['email'] . "<br>";
    // Afficher d'autres colonnes si nécessaire
    echo "<br>";
}

        }
        
              ?>
                    
                    


                </div>
            </div>
                    <footer>
                        <p>Tous droits réservés &copy; 2023 Hôtel Seybouse International annaba </p>
                    </footer>
</body>
</html>