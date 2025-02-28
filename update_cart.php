<?php
// Démarrer la session
session_start();

// Vérifie si l'utilisateur est connecté
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Include config file
        require_once "config.php";
        
        // Initialiser les variables
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];
        $taille = $_POST['taille']; // Récupérer la taille sélectionnée
        
        // Vérifie si le produit est déjà dans le panier de l'utilisateur
        $userID = $_SESSION['userID'];
        $sql_check = "SELECT * FROM Panier WHERE userID = '$userID' AND productID = '$productID' AND taille = '$taille'";
        $result_check = $conn->query($sql_check);
        $count = $result_check->num_rows;
        
        if($count > 0){
            // Le produit est déjà dans le panier, met à jour la quantité
            $sql_update = "UPDATE Panier SET quantite = '$quantity' WHERE userID = '$userID' AND productID = '$productID' AND taille = '$taille'";
            if($conn->query($sql_update) === TRUE){
                echo "<script>alert('La quantité du produit a été mise à jour dans votre panier.');</script>";
                header("location: panier.php");
            } else{
                echo "Erreur : " . $sql_update . "<br>" . $conn->error;
            }
        } else {
            // Le produit n'est pas dans le panier, ajoute le nouveau produit
            $sql_add = "INSERT INTO Panier (userID, productID, quantite, taille) VALUES ('$userID', '$productID', '$quantity', '$taille')";
            if($conn->query($sql_add) === TRUE){
                echo "<script>alert('Le produit a été ajouté à votre panier.');</script>";
                header("location: panier.php");
            } else{
                echo "Erreur : " . $sql_add . "<br>" . $conn->error;
            }
        }
        
        // Fermer la connexion
        $conn->close();
    } else{
        header("location: panier.php");
        exit();
    }
} else {
    // Redirige l'utilisateur vers la page de connexion
    header("Location: page_connexion.php");
    exit();
}
?>
