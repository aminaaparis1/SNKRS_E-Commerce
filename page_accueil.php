
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SNKRS - ACCUEIL</title>
  <link rel="stylesheet" href="page_accueil.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="icon" href="/img/favicon_io-2/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
  <style>
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

  <nav class ="nav2">
    <div class="categories">
      <a href="page_homme.php">Homme</a>
      <a href="page_femme.php">Femme</a>
      <a href="page_enfant.php">Enfants</a>
      <a href="page_produits.php">Produits</a>
    </div>
  </nav>
  
  <table>
    <tr>
      <td class="center-content">
        <div class ="adhesion"><h3>Adhésion à SNKRS</h3></div>
        <p>Profite des avantages des membres SNKRS !</p>
        <button class="button" id="inscriptionButton">Inscris-toi maintenant !</button>
      </td>
      <td class="text-right">
        <img src="img/imageProjetAccueil.JPG" alt="Image">
      </td>
    </tr>
  </table>
  <section class="main">  
    <div class="baniere">
      <img src="img/IMG_0363.jpeg">

      


        </div>
    <div class="cards">

      <div class="card">
        <a href="page_homme.php">
        <img src="img/jordanbalon.webp"> </a>
        <div class="card-header center-text">
          <h4 class="title"  style="text-align: center;">Profitez de nos exclusivités !</h4>
        </div>
        <div class="card-body">
          <p>Achète maintenant</p>
        </div>
      </div>


   


      <div class="card">
        <a href="page_homme.php">
        <img src="img/lacostecote.jpg"> </a>
        <div class="card-header center-text">
          <h4 class="title"  style="text-align: center;">Profitez de nos exclusivités !</h4>
        </div>
        <div class="card-body">
          <p>Achète maintenant</p>
        </div>
      </div>

      <div class="card">
        <a href="page_homme.php">
        <img src="img/tnaccueil.webp"> </a>
        <div class="card-header">
          <h4 class="title">Disponible dès maintenant : 
          Nike Tuned 1</h4>
        </div>
        <div class="card-body">
          <p>Achète Maintenant</p>
        </div>
      </div>
      
      <div class="card">
        <a href="produit_jordan4.php">
            <img src="img/jordan4.webp">
          </a>
        <div class="card-header">
          <h4 class="title">Jordan 4 Retro</h4>
          <h4 class="price">€ 149,99</h4>
        </div>
        <div class="card-body">
          <p>Black-White-Tour Yellow</p>
        </div>
      </div>
      
      <div class="card">
        <a href="produit_shox.php">
        <img src="img/shox.jpeg"> </a>
        <div class="card-header">
          <h4 class="title">Nike Shox TL</h4>
          <h4 class="price">€ 169,99</h4>
        </div>
        <div class="card-body">
          <p>White/ White-Metallic Silver-Max Orange</p>
        </div>
      </div>
      
      <div class="card">
        <a href="produit_nb.php">
        <img src="img/newbalance.webp"></a>
        <div class="card-header">
          <h4 class="title">New Balance 1906R</h4>
          <h4 class="price"> € 109,99</h4>
        </div>
        <div class="card-body">
          <p>Beige-Silver</p>
        </div>
      </div>
      
     </div>
  
    <div class="video">
      <iframe src="https://www.youtube.com/embed/2COSkxxOtXY" allowfullscreen></iframe>
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
    <div class="copyright">
      <p>&copy; 2024 SNKRS. Tous droits réservés. </p>
    </div>
  </footer>
  
</body>
<script>
    // Sélectionnez le bouton "Inscris-toi maintenant !"
  var inscriptionButton = document.getElementById("inscriptionButton");

// Ajoutez un gestionnaire d'événements pour le clic sur le bouton
inscriptionButton.addEventListener("click", function() {
  // Rediriger l'utilisateur vers la page d'inscription
  window.location.href = "page_inscription.php";
});
    // Sélectionnez toutes les images des cartes
    var cardImages = document.querySelectorAll(".card img");
  
    // Parcourez chaque image
    cardImages.forEach(function(image) {
      // Ajoutez un écouteur d'événement pour le survol
      image.addEventListener("mouseenter", function() {
        // Ajoutez un style pour l'effet (par exemple, un changement d'opacité)
        this.style.opacity = "0.7";
      });
  
      // Ajoutez un écouteur d'événement pour lorsque le curseur quitte l'image
      image.addEventListener("mouseleave", function() {
        // Réinitialisez le style (par exemple, l'opacité normale)
        this.style.opacity = "1";
      });
    });
    
  </script>
  
