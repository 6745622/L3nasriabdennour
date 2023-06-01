<?php
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
        // header("Location: magasinier.php");
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
  <title>Magasinier</title>
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
                  <li><a class="navbar-link" href="magasinier.php">Acceuil</a></li>
                  <li><a class="navbar-link" href="service.html">Services</a></li>
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

                cher magasinier. Nous sommes ravis de vous accueillir ici,<br>
                 prêts à vous assister dans la gestion efficace des stocks et à faciliter <br>
                 votre travail quotidien avec des outils et des informations précieuses à portée de main.</p>
         
              
                 <form action="magasinier.php" method="post"><div>
                       <input type="submit" name="recuperer_commande" class="btnn" value="Récupérer les commandes"><br>
                       
                      </form></div>
     <?php
        if (isset($_POST['recuperer_commande'])) {
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


// Requête SQL pour récupérer les bon de commandes 
$requete = "SELECT * FROM bon_commandec";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification du résultat de la requête
if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Affichage des résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "numero de la commande : " . $row['numBC'] . "<br>";
    echo "nom demande : " . $row['nom_commande'] . "<br>";
    echo "contenu de la commande : " . $row['contenu_commande'] . "<br>";
    echo "Date de la commande : " . $row['date'] . "<br>";
    // Afficher d'autres colonnes si nécessaire
    echo "<br>";
}
        }
              ?> 
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

?>        <br>
                 <h3> Verifier et Etablire votre bon de commande: </h3><br>
                 <form action="magasinier.php" method="POST">
              <label for="numBC">Numero de la bon de commande:</label>
                <input type="numirique" id="numBC" name="numBC" required><br><br>
                <label for="nom_commande">Nom de la bon de commande:</label>
                <input type="text" id="nom_commande" name="nom_commande" required><br><br>
                <label for="nom_commande">Date:</label>
                <input type="Date"></label><br><br>
                <label for="contenu_commande">Contenu de la demande:</label><br>
                <textarea id="contenu_commande" name="contenu_commande" rows="5" cols="50" required>

                </textarea><br><br>
                
                <input type="submit" class="btnn" value="Envoyer vers le fournisseur">
</form>
     <?php
        if (isset($_POST['recuperer_recep'])) {
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


// Requête SQL pour récupérer les bon recep
$requete = "SELECT * FROM bon_recep";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification du résultat de la requête
if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Affichage des résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "numero de la reception : " . $row['numBR'] . "<br>";
    echo "nom demande : " . $row['nom_reception'] . "<br>";
    echo "contenu de la commande : " . $row['contenu_reception'] . "<br>";
    echo "Date de la reception: " . $row['date'] . "<br>";
    // Afficher d'autres colonnes si nécessaire
    echo "<br>";
}
        }
              ?> 
           <form action="magasinier.php" method="post"><div>
           <input type="submit" name="recuperer_recep" class="btnn" value="Récupérer bon de reception "><br>
                       
                      </form></div>
                      <br>
                <h3>Etablire bon reception et bon livraison et bon de Prelevement </h3>

                <h3> Etablire votre bon de reception </h3><br>
                 <form action="magasinier.php" method="POST">
              <label for="numBR">Numero de la bon de reception:</label>
                <input type="numirique" id="numBR" name="numBR" required><br><br>
                <label for="nom_reception">Nom de la bon de reception:</label>
                <input type="text" id="nom_reception" name="nom_reception" required><br><br>
                <label for="contenu_reception">Contenu de la reception:</label><br>
                <textarea id="contenu_reception" name="contenu_reception" rows="5" cols="50" required>
              </textarea><br>
                <h3> Etablire votre bon de livraison </h3><br>
             <label for="numBL">Numero de la bon de livraison:</label>
                <input type="numirique" id="numBL" name="numBL" required><br><br>
                <label for="nom_livraison">Nom de la bon de livraison:</label>
                <input type="text" id="nom_livraison" name="nom_livraison" required><br><br>
                <label for="contenu_livraison">Contenu de la livraison:</label><br>
                <textarea id="contenu_livraison" name="contenu_livraison" rows="5" cols="50" required>
                </textarea><br><br>
                <h3> Etablire votre bon de prelevement </h3><br>
             <label for="numBP">Numero de la bon de prelevement:</label>
                <input type="numirique" id="numBP" name="numBP" required><br><br>
                <label for="nom_prelevement">Nom de la bon de prelevement:</label>
                <input type="text" id="nom_prelevement" name="nom_prelevement" required><br><br>
                <label for="contenu_prelevement">Contenu de la prelevement:</label><br>
                <textarea id="contenu_prelevement" name="contenu_prelevement" rows="5" cols="50" required>
                </textarea><br>
                <label for="nom_livraison">Date:</label>
                <input type="Date"></label><br><br>
                <input type="submit" class="btnn" value="Envoyer vers le controleur">


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