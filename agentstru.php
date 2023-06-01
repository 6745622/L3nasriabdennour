<?php

session_start();
if(isset($_SESSION) && !empty($_SESSION)){
    $utilisateurConnecte = true;
    $typeUtilisateur = $_SESSION["user"]["type_utilisateur"];
    // Redirection en fonction du type d'utilisateur
    if ($typeUtilisateur == '1') {
        // header("Location: agentstru.php");
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
  header('Location: accueil.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Agent de Structure</title>
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
                  <li><a class="navbar-link" href="agentstru.php">Acceuil</a></li>
                  <li><a class="navbar-link" href="service.html">Services</a></li>
                <li><a class="navbar-link" href="contacte.html">Contact</a></li>
                <li><a class="navbar-link" href="a-propos.html">A propos</a></li>
                  <form action="deconnexion.php" method="POST">
                    <button class="btnd"><a href="deconnexion.php">Déconnexion</a></button>
                  </form>
                  </ul>
                </div> 
              </div>
</form>
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
 
    $numDA = $_POST["numDA"];
    $nomDemande = $_POST["nom_demande"];
    $contenuDemande = $_POST["contenu_demande"];
     
    // Requête d'insertion dans la base de données
    $requete = "INSERT INTO demandes_achat (numDA,nom_demande, contenu_demande, envoyeur_id, destinataire_id, date) VALUES ('$numDA','$nomDemande', '$contenuDemande', 'envoyeur_id_value', 'destinataire_id_value', NOW())";
    
    if (mysqli_query($connexion, $requete)) {
        echo "La demande d'achat a été enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de la demande d'achat : " . mysqli_error($connexion);
    }
    // Requête pour récupérer les données de la table demandes_achat
$requete = "SELECT * FROM demandes_achat";
$resultat = mysqli_query($connexion, $requete);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}

?>        

                <div class="content">
                
                  <h3><p>Bienvenue sur notre interface,<br> cher agent. Nous sommes ravis de vous accueillir ici,<br>
                   prêts à vous assister dans toutes vos missions avec professionnalisme et dévouement.</p></h3><br>
                <form action="agentstru.php" method="POST">
                <label for="numDA">Numero de la demande:</label>
                <input type="numirique" id="numDA" name="numDA" required><br><br>
                <label for="nom_demande">Nom de la demande:</label>
                <input type="text" id="nom_demande" name="nom_demande" required><br><br>
                <label for="nom_demande">Date:</label>
                <input type="Date"></label><br><br>
                <label for="contenu_demande">Contenu de la demande:</label><br>
                <textarea id="contenu_demande" name="contenu_demande" rows="5" cols="50" required>

                </textarea><br><br>
                
                <input type="submit" class="btnn" value="Envoyer">
                        
              </form>
           
</form>

 <br>      
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
 
    $envoyeur = $_POST["envoyeur"];
    $destinateur =  $_POST["destinateur"];
    $messager = $_POST["messagerD"];
    
    // Requête d'insertion dans la base de données
    $requete = "INSERT INTO messaged (id,envoyeur,destinateur , messagerD ,date) VALUES ('id','$envoyeur','$destinateur','$messager' , NOW())";
    
    if (mysqli_query($connexion, $requete)) {
        echo "le message a été enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement  : " . mysqli_error($connexion);
    }
    
    // Requête pour récupérer les données de la table demandes_achat
    $requete = "SELECT * FROM messaged";
    $resultat = mysqli_query($connexion, $requete);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>        

<form action="agentstru.php" method="POST">
    <label for="envoyeur">envoyeur:</label>
    <input type="texte" id="envoyeur" name="envoyeur" required><br><br>
    <label for="destinateur">destinateur:</label>
    <input type="texte" id="destinateur" name="destinateur" required><br><br>
    <label for="messager ">votre message :</label><br>
    <textarea id="messager" name="messager" rows="5" cols="50" required></textarea><br><br>
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br><br>
    <input type="submit" class="btnn" value="Envoyer">
</form> 
<form action="agentstru.php" method="post"><div>
                       <input type="submit" name="recuperer_messages" class="btnn" value="Récupérer les messages"><br>
                       
                      </form>
     <?php
        if (isset($_POST['recuperer_messages'])) {
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
$requete = "SELECT * FROM  messaged";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification du résultat de la requête
if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Affichage des résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "message envoyer par  : " . $row['envoyeur'] . "<br>";
    echo "destinier : " . $row['destinateur'] . "<br>";
    echo "contenu de message: " . $row['messagerD'] . "<br>";
    echo "Date: " . $row['date'] . "<br>";
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