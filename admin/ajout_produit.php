<?php
require_once("../fonctions/product_crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $img_url = $_POST["img_url"];
    $description = $_POST["description"];

    // Appeler la fonction pour ajouter le produit
    $result = addProduct($name, $quantity, $price, $img_url, $description);

    if ($result) {
        echo "<br><br>Produit ajouté avec succès.";
    } else {
        echo "<br><br>Erreur lors de l'ajout du produit : " . mysqli_error($conn);
    }
}

// Récupérer tous les produits après l'ajout
$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Ajout de produits -->
    <section>
        <h2>Ajout de produits</h2>

        <!-- Formulaire pour ajouter un produit -->
        <form method="post" action="ajout_produit.php">
            <!-- Champ pour le nom du produit -->
            <label for="name">item's Name:</label>
            <input type="text" id="name" name="name" required>

            <!-- Champ pour la quantité -->
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <!-- Champ pour le prix -->
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <!-- Champ pour l'URL de l'image -->
            <label for="img_url"> image's URL:</label>
            <input type="text" id="img_url" name="img_url" required>

            <!-- Champ pour la description -->
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" name="add_product">add product</button>
        </form>
    </section>
    <!-- Back to Admin Dashboard -->
    <section>
        <a href="../results/acceuil.admin.php">Back to Admin Dashboard</a>
    </section>

</body>

</html>