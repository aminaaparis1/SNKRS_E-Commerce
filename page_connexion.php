<?php #Melissa et Amina
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "amina"; 
    $password = "MPN93390a"; 
    $dbname = "projetWeb"; 

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $userID = $_POST['userID'];
    $password = $_POST['password'];

    // Requête SQL pour vérifier les informations d'identification
    $sql = "SELECT * FROM Utilisateur WHERE userID = '$userID' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // L'utilisateur est authentifié avec succès
        $_SESSION['loggedin'] = true; // Définir la variable de session pour indiquer que l'utilisateur est connecté
        $_SESSION['userID'] = $userID; // Stocker l'userID dans la session
        // Redirection vers la page du gestionnaire de compte
        header("Location: gestion_compte.php");
        exit();
    } else {
        // L'utilisateur n'est pas authentifié
        echo "<script>alert('Identifiants incorrects. Veuillez réessayer.');</script>";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="page_accueil.css">

  <title>Formulaire de Connexion</title>
  <style>
 @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
   @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

   footer {
  background-color: #131313df;
  color: white;
  padding: 5%;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.column {
  width: 30%;
}

.column h3 {
  color: #fff;
  font-size: 1em;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.column ul {
  list-style-type: none;
  padding: 0;
}

.column ul li {
  margin-bottom: 10px;
  text-align: left;
}

.contact {
  cursor: pointer;
  color: white;
  text-decoration: underline;
}

.copyright {
  text-align: center;
  width: 100%;
  margin-top: 20px;
}

   body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }
    footer{
    background-color: #131313df;
    color: white;
    text-align: center;
    padding: 5%;
}

    h2 {
      text-align: center;
      
      color: #333;
      margin-bottom: 30px;
    }

     .inscription form{
      max-width: 400px;
      margin: 10;
      background-color: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      color: #555;
      margin-bottom: 5px;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: calc(100% - 22px); 
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      outline: none;
      transition: border-color 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="text"]:focus {
      border-color: #ff9d00;
    }
    .container {
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 40px;
            box-sizing: border-box;
            background-color: #ffffff; /* Blanc */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
            margin-top: 100px;            
            margin-bottom: 100px;

        }


    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #ff9d00;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    button[type="submit"]:hover {
      background-color: black;

    }

    /* Nouvelle règle CSS pour centrer le titre h2 */
    h2 {
      text-align: center;
    }
    .footer-links a {
  color: #ffffff; /* Couleur du texte en blanc */
  text-decoration: none; /* Suppression du soulignement */
  margin-bottom: 10px; /* Marge en bas pour séparer les liens */
  transition: color 0.3s ease; /* Transition pour l'effet hover */
}

.footer-links a:hover {
  color: #ff9d00; /* Couleur du texte au survol en jaune */
}

   
  </style>

</head>

<body>

    <nav>
        <div class="logo">
            <a href="page_accueil.php">SNKRS</a> 
        </div>
        <div class="onglets">
        <form method="GET" action="recherche.php">
    <input type="search" placeholder="Rechercher" name="s">
</form>
        </div>
  </nav>

  
  <!-- Fin de la barre de navigation -->


  <nav class="nav2"> 
        <div class="categories">
            <a href="page_homme.php">Homme</a>
            <a href="page_femme.php">Femme</a>
            <a href="page_enfant.php">Enfants</a>
            <a href="page_produits.php">Produits</a>
        </div>
    </nav>
  <div class="container">
  <h2>Connexion</h2>
    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="inscription">
      <div class="input-group">
        <label for="userID">UserID :</label>
        <input type="text" id="userID" name="userID" required>
      </div>
      <div class="input-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
      </div>
      <p>Pas encore inscrit ? <a href="page_inscription.php" style="color: #ff9d00; text-decoration: none;">Inscrivez-vous ici</a>.</p>
      <button type="submit">Se connecter</button>
    </form>
  </div>

  <footer>
    <!-- Première colonne -->
    <div class="column">
      <h3>Faites votre shopping avec SNKRS</h3>
      <ul>
        <li>Livraison</li>
        <li>Guide des tailles</li>
        <li>Trouver l'un de nos magasin</li>
        <li>Étudiants</li>
        <li>SNKRS Blog</li>
      </ul>
    </div>

    <!-- Deuxième colonne -->
    <div class="column">
      <h3>Contactez-nous ici</h3>
      <ul>
        <li class="contact" onclick="window.location.href='mailto:snkrs@service-client.com'">Contact</li>
        <li>Retours Produits</li>
        <li>FAQs</li>
        <li>Suivre ma Commande</li>
      </ul>
    </div>

    <!-- Troisième colonne -->
    <div class="column">
      <h3>Légal</h3>
      <ul>
        <li>Conditions Générales de Vente</li>
        <li>Confidentialité et Cookies</li>
        <li>Paramètres des Cookies</li>
        <li>Accessibilité</li>
        <li>Politique d'avis en ligne</li>
      </ul>
    </div>
    <p>&copy; 2024 SNKRS. Tous droits réservés. </p>
  </footer>
</body>
</html>
