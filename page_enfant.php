<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/favicon_io-2/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
    <link rel="stylesheet" href="page_accueil.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



    <title>SNKRS - ENFANT</title>
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
          
            <div class="card">
                <a href="produit_airforce.php">
                    <img src="img/airforce.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">Nike Air Force 1 Low Bébé</h4>
                    <h4 class="price">€ 65,00</h4>
                </div>
                <div class="card-body">
                    <p>White</p>
                </div>
            </div>
          
            <div class="card">
                <a href="produit_j4bebe.php">
                    <img src="img/jordanbebe.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">Jordan AJ4 Retro</h4>
                    <h4 class="price"> € 64,99</h4>
                </div>
                <div class="card-body">
                    <p>White-Hyper Violet</p>
                </div>
            </div>


            <div class="card">
                <a href="produit_ozweegoenfant.php">
                    <img src="img/adidasenfant.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">Adidas Originals Ozweego Enfant</h4>
                    <h4 class="price">€ 65,00</h4>
                </div>
                <div class="card-body">
                    <p>White</p>
                </div>
            </div>
          
            <div class="card">
                <a href="produit_nbenfant.php">
                    <img src="img/newbebe.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">New Balance 327</h4>
                    <h4 class="price"> € 69,99</h4>
                </div>
                <div class="card-body">
                    <p>Black-Black</p>
                </div>
            </div>

            

            <div class="card">
                <a href="produit_ozelia.php">
                    <img src="img/ozelia.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">Adidas Ozelia
</h4>
                    <h4 class="price">€ 59,99</h4>
                </div>
                <div class="card-body">
                    <p>Core Black-Core Black-Core Black</p>
                </div>
            </div>

            <div class="card">
                <a href="produit_dunk.php">
                    <img src="img/dunk.webp">
                </a>
                <div class="card-header">
                    <h4 class="title">Nike Dunk Low</h4>
                    <h4 class="price"> € 59,99</h4>
                </div>
                <div class="card-body">
                    <p>Deep Jungle-White-Light Silver</p>
                </div>
            </div>
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
</body>
</html>
