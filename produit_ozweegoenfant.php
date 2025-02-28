 <?php #Melissa et Amina
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCart'])) {
  // Récupérer les données du formulaire
  $nomProduit = "Adidas Originals Ozweego Enfant";
  $prix = 65.00;
  $taille = $_POST['taille'];
  $color = "White";
  $quantite = 1;
  $userID = $_SESSION['userID']; // Récupérer l'userID de l'utilisateur connecté

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

  // Vérifier si le produit existe déjà dans la table Produit
  $stmt = $conn->prepare("SELECT productID FROM Produit WHERE nomProduit = ? AND prix = ? AND taille = ?");
  $stmt->bind_param("sds", $nomProduit, $prix, $taille);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Le produit existe déjà dans la table Produit, récupérer le productID
    $row = $result->fetch_assoc();
    $productID = $row["productID"];
  } else {
    // Le produit n'existe pas dans la table Produit, l'ajouter
    $stmt = $conn->prepare("INSERT INTO Produit (nomProduit, prix, taille, color, image, quantite_stock) VALUES (?, ?, ?, ?, ?, ?)");
    $image = "img/adidasenfant.webp";
    $quantite_stock = 200; // Ajustez selon vos besoins
    $stmt->bind_param("sdsssi", $nomProduit, $prix, $taille, $color, $image, $quantite_stock);
    if ($stmt->execute()) {
      // Récupérer le productID du nouveau produit
      $productID = $conn->insert_id;
    } else {
      echo "Erreur : " . $stmt->error;
    }
  }

  // Vérifier si le produit existe déjà dans le panier
  $stmt = $conn->prepare("SELECT productID FROM Panier WHERE userID = ? AND productID = ?");
  $stmt->bind_param("ii", $userID, $productID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Le produit existe déjà dans le panier
    echo "<script>alert('Le produit a déjà été ajouté. Veuillez modifier la quantité dans votre panier.');</script>";
  } else {
    // Ajouter le produit au panier
    $stmt = $conn->prepare("INSERT INTO Panier (userID, productID, quantite) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $userID, $productID, $quantite);

    if ($stmt->execute()) {
      // Rediriger l'utilisateur vers la page panier
      echo "<script>alert('Le produit a été ajouté au panier.');</script>";
      header("Location: panier.php");
      exit();
    } else {
      echo "Erreur : " . $stmt->error;
    }
  }

  // Fermer la connexion à la base de données
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asics GEL-NYC</title>
  <link rel="stylesheet" href="page_accueil.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    footer{
      background-color: #131313df;
      color: white;
      text-align: center;
      padding: 5%;
    }

    .product-container {
      display: flex;
      align-items: center;
      height: 100vh;
    }

    .product-image {
      flex-grow: 1;
      width: 50%;
      height: 70%;
      object-fit: contain;
    }

    .product-info {
      flex-grow: 1;
      padding: 20px;
      background-color: #fff;
    }

    .product-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .product-color {
      color: #555;
      margin-bottom: 10px;
    }

    .product-price {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .size-select {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }

    .add-to-cart-button {
      background-color: #ff9d00;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    .add-to-cart-button:hover {
      background-color: #ff9d00b1;
    }
    
    /* Barre de navigation */
    nav {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #fff;
      position: sticky;
      top: 0;
    }

    .logo h1 {
      font-size: 40px;
      font-style: italic;
      font-family: "Anton", sans-serif;
      margin: 0;
    }

    .nav2 {
      display: flex;
      justify-content: center;
      background-color: #a2a2a6;
    }

    .nav2 .categories {
      display: flex;
      justify-content: space-between;
      max-width: 800px;
      width: 100%;
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .nav2 .categories a {
      font-size: 17px;
      font-weight: bold;
      margin-right: 20px;
      text-decoration: none;
      color: #fff;
    }

    .nav2 .categories a:last-child {
      margin-right: 0;
    }

    .nav2 .categories a:hover {
      color: #000;
    }

    .nav2 .categories a:focus {
      outline: none;
    }

    .nav2 .categories a:focus-visible {
      outline: 2px solid #fff;
    }

    nav .onglets {
      margin-left: auto;
      display: flex;
      align-items: center;
    }

    nav .onglets p {
      font-size: 17px;
      margin-right: 10px;
      cursor: pointer;
    }

    nav .onglets input {
      margin: 8px 20px;
      padding: 15px;
      border-radius: 30px;
      border: none;
      background-color: #f2f2f2;
      outline: none;
    }

    .onglets .connexion {
      color: #333;
      text-decoration: none;
      padding: 10px 15px;
      border: 1px solid #333;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .onglets .connexion:hover {
      background-color: #757575;
      color: #fff;
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

    /* Fin de la barre de navigation */
  </style>
</head>
<body>
   <!-- Barre de navigation -->
   <nav>
    <div class="logo">
      <a href="page_accueil.php">SNKRS</a> 
    </div>
    <div class="onglets">
    <form method="GET" action="recherche.php">
    <input type="search" placeholder="Rechercher" name="s">
</form>

      <a href="panier.php"style="color: #000000;text-decoration:none;">
        <i class="fas fa-shopping-cart"></i>
        <span class="nav-text" style="color: #000000;text-decoration:none;">Panier</span>
      </a>
      <?php 
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
          // Si l'utilisateur est connecté
          // Connexion à la base de données
          $servername = "localhost";
          $username = "amina"; // Mettez votre nom d'utilisateur MySQL
          $password = "MPN93390a"; // Mettez votre mot de passe MySQL
          $dbname = "projetWeb"; // Mettez le nom de votre base de données
      
          // Création de la connexion
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Vérification de la connexion
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Récupération du prénom de l'utilisateur connecté depuis la base de données
          $userID = $_SESSION['userID'];
          $sql = "SELECT prenom FROM Utilisateur WHERE userID = '$userID'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Affichage du prénom de l'utilisateur
            $row = $result->fetch_assoc();
            echo '<a href="gestion_compte.php" style="color: #000000;text-decoration:none;"><i class="fas fa-user"></i><span class="nav-text">' . $row["prenom"] . '</span></a>';
          } else {
            echo "0 results";
          }
          $conn->close();
        } else {
          // Si l'utilisateur n'est pas connecté, affiche un lien vers la page de connexion
          echo '<a href="page_connexion.php" style="color: #000000;text-decoration:none;"><i class="fas fa-user"></i><span class="nav-text">Connexion</span></a>';
        }
      ?>
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
  <div class="product-container">
    <img class="product-image" src="img/adidasenfant.webp" alt="Product Image">
    <div class="product-info">
        <h2 class="product-title">Adidas Originals Ozweego Enfant</h2>
        <p class="product-color">Couleur : White</p>
        <p class="product-price">Prix : €65,00</p>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="productID" value="<?php echo $productID; ?>"> <!-- Utiliser la valeur dynamique du productID -->
    <select class="size-select" name="taille">
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
    </select>
    <button type="submit" class="add-to-cart-button" name="addToCart" value="Ajouter au Panier">Ajouter au Panier</button>
</form>

    </div>
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



