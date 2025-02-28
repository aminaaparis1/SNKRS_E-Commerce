<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SNKRS - PANIER</title>
  <link rel="stylesheet" href="page_accueil.css">
  <link rel="icon" href="/img/favicon_io-2/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
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
    }
    
    .logo a {
      font-size: 40px;
      font-style: italic;
      font-family: "Anton", sans-serif;
      margin: 0;
      color: #000;
      text-decoration: none;
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
    
    .container {
      margin-top: 20px;
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 10px;
      text-align: left;
    }
    
    th {
      background-color: #333;
      color: #fff;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    
    tr:hover {
      background-color: #ddd;
    }

    .btn-passer-commande {
      background-color: orange;
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 4px;
      margin-top: 20px;
      font-size: 18px;
      text-align: left;
      cursor: pointer;

    } 
    center {
  display: block;
  margin: 0 auto;
  text-align: center;
}

    .btn-passer-commande:hover {
      background-color:black;
    }
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

  <!-- Navigation -->
  <nav class="nav2"> 
    <div class="categories">
      <a href="page_homme.php">Homme</a>
      <a href="page_femme.php">Femme</a>
      <a href="page_enfant.php">Enfants</a>
      <a href="page_produits.php">Produits</a>
    </div>
  </nav>
  <!-- Fin de la navigation -->

  <!-- Tableau du panier -->
  <div class="container">
    <?php 
    // Vérifie si l'utilisateur est connecté
    session_start();
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

      // Si un produit doit être supprimé du panier
      if(isset($_POST['delete']) && isset($_POST['productID'])){
        $productID = $_POST['productID'];
        $userID = $_SESSION['userID']; // Pour être sur que $_SESSION['userID'] est correctement défini

        // Supprime le produit du panier de l'utilisateur connecté
        $sql_delete = "DELETE FROM Panier WHERE userID = '$userID' AND productID = '$productID'";
        if ($conn->query($sql_delete) === TRUE) {
          echo "<script>alert('Le produit a été supprimé du panier avec succès');</script>";
        } else {
          echo "Erreur: " . $sql_delete . "<br>" . $conn->error;
        }
      }

      // Met à jour la quantité du produit dans le panier
      if(isset($_POST['productID']) && isset($_POST['quantity'])){
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];
        $userID = $_SESSION['userID']; // Assurez-vous que $_SESSION['userID'] est correctement défini

        // Met à jour la quantité du produit dans le panier de l'utilisateur connecté
        $sql_update = "UPDATE Panier SET quantite = '$quantity' WHERE userID = '$userID' AND productID = '$productID'";
        if ($conn->query($sql_update) === TRUE) {
          echo "<script>alert('La quantité du produit a été mise à jour avec succès');</script>";
        } else {
          echo "Erreur: " . $sql_update . "<br>" . $conn->error;
        }
      }

      // Récupère le panier de l'utilisateur connecté depuis la base de données
      $userID = $_SESSION['userID']; // Assurez-vous que $_SESSION['userID'] est correctement défini
      $sql = "SELECT Panier.productID, Produit.nomProduit, Produit.prix, Produit.taille, Produit.color, Panier.quantite, Produit.image FROM Panier JOIN Produit ON Panier.productID = Produit.productID WHERE userID = '$userID'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Affiche les éléments du panier
          echo "<h2>Votre panier</h2>";
          echo "<table>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Image</th>";
          echo "<th>Produit</th>";
          echo "<th>Prix unitaire</th>";
          echo "<th>Taille</th>";
          echo "<th>Quantité</th>";
          echo "<th>Total</th>";
          echo "<th>Supprimer</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          // Initialiser le montant total de la commande
          $totalOrder = 0;

          while($row = $result->fetch_assoc()) {
              $productID = $row['productID'];
              echo "<tr>";
              echo "<td><img src='" . $row['image'] . "' alt='" . $row['nomProduit'] . "' style='width: 200px; height: 200px;'></td>";
              echo "<td>" . $row['nomProduit'] . "</td>";
              echo "<td class='prix-unitaire'>" . $row['prix'] . "€</td>";
              echo "<td>" . $row['taille'] . "</td>";
              echo "<td><input type='number' value='" . $row['quantite'] . "' min='1' max='10' data-product-id='" . $productID . "' class='quantity'></td>";
              $totalProductPrice = $row['prix'] * $row['quantite'];
              echo "<td class='prix'>" . $totalProductPrice . "€</td>";
              echo "<td>";
              echo "<form method='post' action='panier.php'>";
              echo "<input type='hidden' name='productID' value='" . $productID . "'>";
              echo "<button type='submit' name='delete' style='background: none; border: none; color: orange; cursor: pointer; display: block; margin: 0 auto; font-size: 24px;'><i class='fas fa-trash-alt'></i></button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";

              // Ajouter le prix de ce produit au montant total de la commande
              $totalOrder += $totalProductPrice;
          }
          echo "</tbody>";
          echo "</table>";

          echo "<h3>Total de la commande : <span id='totalOrder'>" . $totalOrder . "€</span></h3>";

          // Bouton "Passer la commande"
          echo "<form action='validation_commande.php' method='post' >";
          echo "<input type='hidden' name='totalOrder' value='" . $totalOrder . "'>";
          echo "<input type='submit' value='Passer la commande' class='btn-passer-commande center'>";
          echo "</form>";
      } else {
          echo "<h2>Votre panier</h2>";
          echo "<p>Votre panier est vide.</p>";
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
  </div>
  <!-- Fin du tableau du panier -->

  <script>
    // Met à jour le prix total lorsqu'on change la quantité
    const quantities = document.querySelectorAll('.quantity');
    quantities.forEach(quantity => {
      quantity.addEventListener('change', function() {
        const productID = this.getAttribute('data-product-id');
        const newQuantity = parseInt(this.value);
        const row = this.parentNode.parentNode;
        const pricePerUnit = parseFloat(row.querySelector('.prix-unitaire').innerText);
        const totalPrice = pricePerUnit * newQuantity;
        row.querySelector('.prix').innerText = totalPrice.toFixed(2) + '€';
        updateTotalOrder();
        // Sauvegarde la nouvelle quantité dans sessionStorage
        sessionStorage.setItem('quantity_' + productID, newQuantity);
        // Met à jour la quantité dans la table Panier
        fetch('panier.php', {
          method: 'POST',
          body: new URLSearchParams({
            productID: productID,
            quantity: newQuantity
          })
        })
        .then(response => response.text())
        .then(data => {
          console.log(data);
        })
        .catch(error => {
          console.error('Erreur lors de la mise à jour de la quantité dans la table Panier:', error);
        });
      });
    });

    // Charge les quantités du panier depuis sessionStorage
    window.addEventListener('DOMContentLoaded', function() {
      const storedQuantities = Object.entries(sessionStorage);
      storedQuantities.forEach(entry => {
        const [key, value] = entry;
        if (key.startsWith('quantity_')) {
          const productID = key.split('_')[1];
          const quantityInput = document.querySelector('.quantity[data-product-id="' + productID + '"]');
          if (quantityInput) {
            quantityInput.value = value;
            const row = quantityInput.parentNode.parentNode;
            const pricePerUnit = parseFloat(row.querySelector('.prix-unitaire').innerText);
            const totalPrice = pricePerUnit * parseInt(value);
            row.querySelector('.prix').innerText = totalPrice.toFixed(2) + '€';
          }
        }
      });
      updateTotalOrder();
    });

    // Met à jour le montant total de la commande
    function updateTotalOrder() {
      let totalOrder = 0;
      const totalPriceElements = document.querySelectorAll('.prix');
      totalPriceElements.forEach(element => {
        totalOrder += parseFloat(element.innerText);
      });
      document.getElementById('totalOrder').innerText = totalOrder.toFixed(2) + '€';
    }
  </script>
</body>
</html>