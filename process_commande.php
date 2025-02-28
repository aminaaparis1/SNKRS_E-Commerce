<?php
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

  // Récupérer l'email de l'utilisateur connecté
  $email = "";
  $sql_get_email = "SELECT email FROM Utilisateur WHERE userID = $userID";
  $result_email = $conn->query($sql_get_email);
  if ($result_email->num_rows > 0) {
    $row_email = $result_email->fetch_assoc();
    $email = $row_email["email"];
  } else {
    echo "Utilisateur non trouvé";
    exit();
  }

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

    // Mettre à jour la quantité en stock des produits
    $sql_update_stock = "UPDATE Produit 
                        INNER JOIN Panier ON Produit.productID = Panier.productID
                        SET Produit.quantite_stock = Produit.quantite_stock - Panier.quantite
                        WHERE Panier.userID = $userID";

    if ($conn->query($sql_update_stock) === TRUE) {
      // Récupérer les informations du panier de l'utilisateur
      $sql = "SELECT Produit.nomProduit, Panier.quantite FROM Panier JOIN Produit ON Panier.productID = Produit.productID WHERE userID = '$userID'";
      $result = $conn->query($sql);

      // Supprimer les éléments du panier de l'utilisateur après validation de la commande
      $sql_delete = "DELETE FROM Panier WHERE userID = '$userID'";
      if ($conn->query($sql_delete) === TRUE) {
        // Envoi d'un mail à l'utilisateur
        $to = $email; // Adresse email de l'utilisateur
        $subject = "Votre commande sur SNKRS";
        $message = "Votre commande a été validée avec succès.\n\n";
        $message .= "Numéro de commande : $orderID\n\n";
        $message .= "Détails de la commande : \n";
        while($row = $result->fetch_assoc()) {
          $message .= "Nom du produit: " . $row["nomProduit"]. " - Quantité: " . $row["quantite"]. "\n";
        }
        $message .= "\n\nTotal de la commande : $totalOrder\n";
        $headers = "From: webmaster@example.com" . "\r\n" .
        "CC: somebodyelse@example.com";
        mail($to,$subject,$message,$headers);
        
        // Redirection vers la page panier
        header("Location: panier.php");
        // Alert JavaScript
        echo '<script>alert("Votre commande a bien été effectuée 🥳 !");</script>';
        exit();
      } else {
        echo "Erreur lors de la suppression du panier: " . $conn->error;
      }
    } else {
      echo "Erreur lors de la mise à jour de la quantité en stock: " . $conn->error;
    }
  } else {
    echo "Erreur : " . $stmt->error;
  }

  // Fermer la connexion à la base de données
  $conn->close();
}
?>
