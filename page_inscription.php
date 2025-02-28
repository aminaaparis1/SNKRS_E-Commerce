<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="page_accueil.css">
  <style>
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

    .inscription form {
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
    }

    button[type="submit"]:hover {
      background-color: black;
    }

    /* Nouvelle règle CSS pour centrer le titre h2 */
    h2 {
      text-align: center;
    }
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

  </style>
</head>
<body> 
<?php #Melissa et Amina
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Vérification de l'email
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Adresse email invalide");</script>';
  } else {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "amina"; // Mettez votre nom d'utilisateur MySQL
    $password = "MPN93390a"; // Mettez votre mot de passe MySQL
    $dbname = "projetWeb"; // Mettez le nom de votre base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
      die("La connexion a échoué : " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['codePostal'];

    // Préparer et exécuter la requête SQL pour insérer les données dans la base de données
    $stmt = $conn->prepare("INSERT INTO Utilisateur (email, password, prenom, nom, addresse, codePostal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $password, $prenom, $nom, $adresse, $codePostal);

    if ($stmt->execute()) {
      // Récupérer l'ID de l'utilisateur nouvellement inscrit
      $userID = $stmt->insert_id;
      echo "<script>alert('Nouvel enregistrement créé avec succès. L\'identifiant unique de l\'utilisateur est : $userID');</script>";
    } else {
      echo '<script>alert("Erreur : ' . $stmt->error . '");</script>';
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
  }
}
?>

  <!-- Barre de navigation -->
  <nav>
    <div class="logo">
      <a href="page_accueil.php">SNKRS</a> 
    </div>
    <div class="onglets">
      <form >
        <input type="search" placeholder="Rechercher">
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
    <h2>Inscription</h2>
    <form id="inscriptionForm" action="page_inscription.php" method="POST" class="inscription">
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
      </div>
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
      </div>
      <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>
      </div>
      <div class="form-group">
        <label for="codePostal">Code Postal :</label>
        <input type="text" id="codePostal" name="codePostal" required>
      </div>

      <p>Déjà inscrit ? <a href="page_connexion.php" style="color: #ff9d00; text-decoration: none;">Connectez-vous ici</a>.</p>
      <button type="submit">S'inscrire</button>
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
