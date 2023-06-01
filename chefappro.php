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
        // header("Location: chefappro.php");
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
  <title>Chef d'approvisionnement</title>
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
                  <li><a class="navbar-link" href="chefappro.php">Acceuil</a></li>
                  <li><a class="navbar-link" href="service.html">Services</a></li>
                 <li><a class="navbar-link" href="contacte.html">Contact</a></li>
                 <li><a class="navbar-link" href="a-propos.html">A propos</a></li>
                  <form action="deconnexion.php" method="POST">
                    <button class="btnd"><a href="deconnexion.php">Déconnexion</a></button>
                  </form>
                  </ul>
                </div>    
           
            </div>
            
            <div class="content"> 
              <h3>Bienvenue sur notre interface,</h3></br>
                <p class="par"> cher chef d'approvisionnement.<br>
                       Nous sommes heureux de vous accueillir dans notre plateforme,<br> 
                       prêts à vous accompagner dans la gestion efficace et optimisée de vos approvisionnements.</p>

                       
</form>
                       <form action="chefappro.php" method="post"><div>
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
              <h3>Modifier ou Ecrire un nouvelle demande d'achat</h3><br> </a>
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
                
                <input type="submit" class="btnn" value="Envoyer vers controleur ">

              </form>
</form>
<br>
 <?php
 // Configuration de la connexion à la base de données
 $serveur = "localhost"; 
 $utilisateur = "root";  
 $motDePasse = "";  
 $baseDeDonnees = "hotel_bdd"; 

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion à la base de données
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $numBC = $_POST["numBC"];
    $nomCommande = $_POST["nom_commande"];
    $contenuCommande = $_POST["contenu_commande"];
     
    // Requête d'insertion dans la base de données
    $requete = "INSERT INTO bon_commandec (numBC,nom_commande, contenu_commande, envoyeur_id, destinataire_id, date) VALUES ('$numBC','$nomCommande', '$contenuCommande', 'envoyeur_id_value', 'destinataire_id_value', NOW())";
    
    if (mysqli_query($connexion, $requete)) {
        echo "La bon commande a été enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de la  bon commande : " . mysqli_error($connexion);
    }
    // Requête pour récupérer les données de la table bon_commande
$requete = "SELECT * FROM  bon_commandec";
$resultat = mysqli_query($connexion, $requete);

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}

?>        
                 <h3> Etablire votre bon de commande</h3><br>
                 <form action="chefappro.php" method="POST">
              <label for="numBC">Numero de la bon de commande:</label>
                <input type="numirique" id="numBC" name="numBC" required><br><br>
                <label for="nom_commande">Nom de la bon de commande:</label>
                <input type="text" id="nom_commande" name="nom_commande" required><br><br>
                <label for="nom_commande">Date:</label>
                <input type="Date"></label><br><br>
                <label for="contenu_commande">Contenu de la demande:</label><br>
                <textarea id="contenu_commande" name="contenu_commande" rows="5" cols="50" required>

                </textarea><br><br>
                
                <input type="submit" class="btnn" value="Envoyer vers achteur">
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
</form><br>
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