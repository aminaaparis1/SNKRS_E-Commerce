<?php #Melissa et Amina
session_start();

if(isset($_POST['validerCommande'])) {
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

  $userID = $_SESSION['userID']; // Assurez-vous que $_SESSION['userID'] est correctement défini

  // Insérer la commande dans la table Commande
  $livraison = $_POST['livraison'];
  $totalOrder = $_POST['totalOrder'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $adresse = $_POST['adresse'];
  $ville = $_POST['ville'];
  $code_postal = $_POST['code_postal'];
  $pays = $_POST['pays'];

  $stmt = $conn->prepare("INSERT INTO Commande (userID, totalOrder, livraison, nom, prenom, adresse, ville, code_postal, pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("idsssssis", $userID, $totalOrder, $livraison, $nom, $prenom, $adresse, $ville, $code_postal, $pays);
  if ($stmt->execute()) {
    $orderID = $stmt->insert_id; // Récupérer le orderID de la nouvelle commande

    // Récupérer les informations du panier de l'utilisateur
    $sql = "SELECT Panier.productID, Panier.quantite FROM Panier JOIN Produit ON Panier.productID = Produit.productID WHERE userID = '$userID'";
    $result = $conn->query($sql);

    // Supprimer les éléments du panier de l'utilisateur après validation de la commande
    $sql_delete = "DELETE FROM Panier WHERE userID = '$userID'";
    if ($conn->query($sql_delete) === TRUE) {
      // Envoi d'un mail à l'utilisateur
      $to = "votre_email@example.com";
      $subject = "Votre commande sur SNKRS";
      $message = "Votre commande a été validée avec succès.\n\n";
      $message .= "Numéro de commande : $orderID\n\n";
      $message .= "Détails de la commande : \n";
      while($row = $result->fetch_assoc()) {
        $message .= "ProductID: " . $row["productID"]. " - Quantité: " . $row["quantite"]. "\n";
        // Mettre à jour la quantité en stock des produits
        $productID = $row["productID"];
        $quantite = $row["quantite"];
        $sql_update_stock = "UPDATE Produit SET quantite_stock = quantite_stock - $quantite WHERE productID = $productID";
        if ($conn->query($sql_update_stock) !== TRUE) {
          echo "Erreur lors de la mise à jour de la quantité en stock: " . $conn->error;
        }
      }
      $message .= "\n\nTotal de la commande : $totalOrder\n";
      $headers = "From: webmaster@example.com" . "\r\n" .
      "CC: somebodyelse@example.com";
      mail($to,$subject,$message,$headers);
      // Redirection vers la page panier
      header("Location: panier.php");
      exit();
    } else {
      echo "Erreur lors de la suppression du panier: " . $conn->error;
    }
  } else {
    echo "Erreur : " . $stmt->error;
  }

  // Fermer la connexion à la base de données
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Validation de la commande</title>
  <link rel="stylesheet" href="page_accueil.css">
  <link rel="icon" href="/img/favicon_io-2/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
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



  <div class="container">
    <div class="produits">
      <h2>Résumé de votre commande</h2>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Taille</th>
            <th>Quantité</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            // Vérifie si l'utilisateur est connecté
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
              // L'utilisateur est connecté, tu peux afficher son panier ici
              // Récupère les données du panier de l'utilisateur connecté depuis la base de données
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

              $userID = $_SESSION['userID']; // Assurez-vous que $_SESSION['userID'] est correctement défini
              
              // Récupère le panier de l'utilisateur connecté depuis la base de données
              $sql = "SELECT Panier.productID, Produit.nomProduit, Produit.prix, Produit.taille, Produit.color, Panier.quantite, Produit.image FROM Panier JOIN Produit ON Panier.productID = Produit.productID WHERE userID = '$userID'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // Affiche les éléments du panier
                while($row = $result->fetch_assoc()) {
                  $productID = $row['productID'];
                  echo "<tr>";
                  echo "<td><img src='" . $row['image'] . "' alt='" . $row['nomProduit'] . "style='max-width: 300px; max-height: 300px;'></td>";
                  echo "<td>" . $row['nomProduit'] . "</td>";
                  echo "<td>" . $row['prix'] . "€</td>";
                  echo "<td>" . $row['taille'] . "</td>";
                  echo "<td>" . $row['quantite'] . "</td>";
                  echo "<td>" . ($row['prix'] * $row['quantite']) . "€</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='6'>Votre panier est vide.</td></tr>";
              }

              // Fermer la connexion à la base de données
              $conn->close();
            } else {
              // L'utilisateur n'est pas connecté, affiche une alerte
              echo '<script>alert("Vous devez vous connecter ou vous inscrire pour accéder à votre panier.");</script>';
              // Redirige l'utilisateur vers la page de connexion
              header("Location: page_connexion.php");
              exit();
            }
          ?>
        </tbody>
      </table>
      <?php 
        // Calcul du total de la commande
        $totalOrder = 0;
        if ($result->num_rows > 0) {
          $result->data_seek(0);
          while($row = $result->fetch_assoc()) {
            $totalOrder += ($row['prix'] * $row['quantite']);
          }
        }
        echo "<h3>Sous-Total de la commande : " . $totalOrder . "€</h3>";
      ?>
    </div>

    <div class="livraison">
      <h2>Informations de livraison</h2>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required><br><br>
        <label for="adresse">Adresse de livraison</label>
        <textarea id="adresse" name="adresse" required></textarea><br><br>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" required><br><br>
        <label for="code_postal">Code postal</label>
        <input type="text" id="code_postal" name="code_postal" required><br><br>
        <label for="pays">Pays</label>
        <input type="text" id="pays" name="pays" required><br><br>
        <label for="livraison">Option de livraison</label>
        <select id="livraison" name="livraison" required>
          <option value="" selected disabled>Choisir une option de livraison</option>
          <option value="standard">Livraison standard (2,99€)</option>
          <option value="express">Livraison express (7,99€)</option>
        </select><br><br>
        <input type="hidden" name="totalOrder" value="<?php echo $totalOrder; ?>">
        <h3 id="total"></h3>
        <input type="submit" name="validerCommande" value="Valider la commande">
      </form>
    </div>
  </div>

  <!-- Style -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
  font-family: 'Open Sans', sans-serif;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  flex-wrap: wrap;
  margin-top: 20px;
  background-color: #f7f7f7;
}

nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #fff;
  position: sticky;
  top: 0;
  width: 100%;
}

.logo a {
  font-size: 40px;
  font-style: italic;
  font-family: "Anton", sans-serif;
  margin: 0;
  color: #000;
  text-decoration: none;
}

.onglets {
  display: flex;
}

.onglets form {
  margin-right: 20px;
}

.onglets a {
  color: #000000;
  text-decoration: none;
  margin-left: 20px;
}


.container {
  display: flex;
  justify-content: space-between;
  max-width: 1200px;
  width: 100%;
  margin-top: 20px;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.produits {
  flex-basis: 48%;
}

.livraison {
  flex-basis: 48%;
}

h2 {
  font-family: 'Anton', sans-serif;
  color: #333;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

form {
  max-width: 400px;
}

label {
  font-weight: bold;
  color: #555;
}

input[type="text"], textarea, select {
  width: 100%;
  padding: 8px;
  margin-top: 6px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: orange;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #ff6d00;
}








.container {
  display: flex;
  justify-content: space-between;
  max-width: 1200px;
  width: 100%;
  margin-top: 20px;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.produits {
  flex-basis: 40%; /* Ajustement de la largeur de la section produits */
}

.livraison {
  flex-basis: 50%; /* Ajustement de la largeur de la section livraison */
  margin-left: 20px; /* Décalage vers la droite */
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

form {
  max-width: 400px;
}

label {
  font-weight: bold;
  color: #555;
}

input[type="text"], textarea, select {
  width: 100%;
  padding: 8px;
  margin-top: 6px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: orange;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #ff6d00;
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
  <!-- Fin du style -->

  <script>
    // Calcul du total de la commande
    document.addEventListener("DOMContentLoaded", function() {
      const selectLivraison = document.getElementById("livraison");
      selectLivraison.addEventListener("change", function() {
        const totalOrder = <?php echo $totalOrder ?>;
        let fraisLivraison = 0;
        if (this.value === "standard") {
          fraisLivraison = 2.99;
        } else if (this.value === "express") {
          fraisLivraison = 7.99;
        }
        const total = totalOrder + fraisLivraison;
        const totalElement = document.getElementById("total");
        totalElement.textContent = `Total de la commande : ${total.toFixed(2)}€ (Frais de livraison : ${fraisLivraison.toFixed(2)}€)`;
      });
    });
  </script>
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

























