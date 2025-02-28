<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/favicon_io-2/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="page_accueil.css">
    <title>Résultats de la recherche</title>

    <style>
    
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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



        .logo a {
            font-size: 40px;
            font-style: italic;
            font-family: "Anton", sans-serif;
            margin: 0;
            text-decoration: none;
            color: #000;
            
      
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

        nav .onglets i {
            text-decoration: none;
            color: #000;
            display: flex;
            margin: 20px;
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

        /* Fin de la barre de navigation */

        .main {
            margin: 20px auto;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Toutes les cartes */
        .cards {
            display: flex;
            flex-wrap: wrap;
            margin: auto;
            justify-content: center;
        }

        .cards .card {
            margin-right: 20px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .cards .card img {
            width: 320px;
            height: auto;
        }

        .cards .card .card-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .cards .card .card-body p {
            margin-top: -10px;
            font-size: 12px;
            color: #333;
        }

        .cards .card img {
            height: 320px;
            width: 320px;
        }

        /* Effet de zoom lors du survol */
        .card img:hover {
            transform: scale(1.1);
        }

        section {
            margin: 50px;
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
      <?php #Melissa et Amina
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


    <section class="main">  
        <div class="cards">
            <?php
            // Configuration de la connexion à la base de données
            $servername = "localhost";
            $username = "amina";
            $password = "MPN93390a";
            $dbname = "projetWeb";

            // Créer une connexion
            $connexion = new mysqli($servername, $username, $password, $dbname);

            // Vérification de la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

// Vérification si le terme de recherche est présent dans l'URL
if (isset($_GET['s'])) {
    $recherche = $_GET['s'];

    // Préparation de la requête SQL pour rechercher dans la base de données
    $requete = "SELECT * FROM Catalogue WHERE nomProduit LIKE '%$recherche%'";

    // Ajouter la condition supplémentaire pour la recherche par marque
    if (!is_numeric($recherche)) { // Vérifie si la recherche n'est pas un nombre
        
    }

    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
 // Affichage des résultats de la recherche
echo "<h2>Résultats de la recherche pour $recherche :</h2> \n \n\n\n\n\n ";
echo "<div class='cards'>"; // Début de la section des cartes

$groupes_affiches = array(); // Tableau pour stocker les groupes déjà affichés

while ($row = $resultat->fetch_assoc()) {
    // Vérifier si le groupe a déjà été affiché
    if (!in_array($row['groupe'], $groupes_affiches)) {
        // Afficher l'article
        echo "<div class='card'>";
        echo "<a href='" . $row['lien'] . "'>"; // Lien vers la page associée à la chaussure
        echo "<img src='" . $row['image'] . "'>";
        echo "</a>";
        echo "<div class='card-header'>";
        echo "<h4 class='title'>" . $row['nomProduit'] . "</h4>";
        echo "<h4 class='price'>€ " . $row['prix'] . "</h4>";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<p>" . $row['description'] . "</p>";
        echo "</div>";
        echo "</div>";
        

        // Ajouter le groupe au tableau des groupes affichés
        $groupes_affiches[] = $row['groupe'];
    }
}

echo "</div>"; // Fin de la section des cartes

    } else {
        echo "<h2>Aucun résultat trouvé pour : $recherche</h2>";
    }
} else {
    echo "<h2>Veuillez entrer un terme de recherche.</h2>";
}


            ?>
        </div>
    </section>

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

