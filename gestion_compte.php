<?php #Melissa et Amina
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté en vérifiant la variable de session
if (!isset($_SESSION['userID'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: page_connexion.php");
    exit();
}

// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "amina";
$password = "MPN93390a";
$dbname = "projetWeb";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Si le formulaire de modification est soumis
if (isset($_POST['modifier'])) {
    // Récupérer les données du formulaire
    $userID = $_POST['userID'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['addresse']; // Changer ici de "adresse" à "addresse"
    $codePostal = $_POST['codePostal'];

    // Préparer et exécuter la requête SQL pour mettre à jour les données de l'utilisateur
    $sql = "UPDATE Utilisateur SET email='$email', password='$password', prenom='$prenom', nom='$nom', addresse='$adresse', codePostal='$codePostal' WHERE userID='$userID'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Les données ont été modifiées avec succès.");</script>';
        // Mettre à jour les données de la session
        $_SESSION['email'] = $email;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['addresse'] = $adresse; // Changer ici de "adresse" à "addresse"
        $_SESSION['codePostal'] = $codePostal;
    } else {
        echo "Erreur lors de la modification des données : " . $conn->error;
    }
}

// Si le formulaire de suppression est soumis
if (isset($_POST['supprimer'])) {
    // Récupérer l'identifiant de l'utilisateur à supprimer
    $userID = $_POST['userID'];

    // Préparer et exécuter la requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM Utilisateur WHERE userID='$userID'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Le compte a été supprimé avec succès.");</script>';
        // Détruire la session et rediriger vers la page de connexion
        session_destroy();
        header("Location: page_connexion.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du compte : " . $conn->error;
    }
}

// Récupérer les données de l'enregistrement correspondant à l'userID de l'utilisateur connecté
$sql = "SELECT * FROM Utilisateur WHERE userID='{$_SESSION['userID']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher le formulaire de modification
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Gestionnaire de compte Utilisateur</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

            body {
                font-family: "Open Sans", sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
                font-size: 26px;
                color: black;
            }

            h3 {
                font-size: 20px;
                color: black;
                margin-bottom: 15px;
            }

            form {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input[type="text"],
            input[type="password"] {
                width: calc(100% - 22px);
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            input[type="submit"] {
                background-color: black;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
            }

            input[type="submit"]:hover {
                background-color: #f2f2f2;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            tr:hover {
                background-color: #f2f2f2;
            }

            th {
                background-color: black;
                color: white;
            
            }

            .success {
                background-color: #d4edda;
                color: #155724;
                border-color: #c3e6cb;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .error {
                background-color: #f8d7da;
                color: #721c24;
                border-color: #f5c6cb;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            /* Nouveau style pour la barre de navigation */
            nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center; /* Centrer verticalement */
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
            .logo h1 a {
                text-decoration: none;
                color: black;
            }
            nav .onglets {
                margin-left: auto; /* Mettre les onglets à droite */
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
                color: #333; /* Couleur du texte */
                text-decoration: none; /* Supprime les soulignements par défaut */
                padding: 10px 15px; /* Ajoute un peu d'espace autour du texte */
                border: 1px solid #333; /* Ajoute une bordure */
                border-radius: 5px; /* Ajoute des coins arrondis */
                transition: background-color 0.3s ease; /* Ajoute une transition pour un effet de survol */
            }
            .onglets .connexion:hover {
                background-color: #757575; /* Change la couleur de fond au survol */
                color: #fff; /* Change la couleur du texte au survol */
            }
        </style>
        <script>
            function showPassword() {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            }
        </script>
        <link rel="stylesheet" href="page_accueil.css">
    </head>
    <body>
        <!-- Barre de navigation -->
        <nav>
            <div class="logo">
                <a href="page_accueil.php">SNKRS</a> 
            </div>
            <div class="onglets">
                <form>
                    <input type="search" placeholder="Rechercher">
                </form>
                <a href="panier.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </nav>
        <!-- Fin de la barre de navigation -->
        <div class="container">
            <h2>Gestionnaire de compte Utilisateur</h2>

            <h3>Modifier le compte</h3>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
                <label>Email:</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
                <label>Mot de passe:</label>
                <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>">
                <input type="checkbox" id="showPassword" onclick="showPassword()">
                <label for="showPassword">Afficher le mot de passe</label><br><br>
                <label>Prénom:</label>
                <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>"><br><br>
                <label>Nom:</label>
                <input type="text" name="nom" value="<?php echo $row['nom']; ?>"><br><br>
                <label>Adresse:</label>
                <input type="text" name="addresse" value="<?php echo $row['addresse']; ?>"><br><br>
                <label>Code Postal:</label>
                <input type="text" name="codePostal" value="<?php echo $row['codePostal']; ?>"><br><br>
                <input type="submit" name="modifier" value="Modifier">
            </form>

            <h3>Supprimer le compte</h3>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
                <input type="submit" name="supprimer" value="Supprimer">
            </form>

            <h3>Historique des commandes</h3>
            <?php
                $sql = "SELECT * FROM Commande WHERE userID='{$_SESSION['userID']}'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>Numéro de commande</th>
                                <th>Total</th>
                                <th>Livraison</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row['orderID']."</td>
                                <td>".$row['totalOrder']."</td>
                                <td>".$row['livraison']."</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucune commande trouvée.";
                }
            ?>
            <form action="deconnexion.php">
                <input type="submit" value="Se déconnecter" >
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Aucun enregistrement trouvé avec cet ID.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
