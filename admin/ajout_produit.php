<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $img_url = $_POST["img_url"];
    $description = $_POST["description"];

    // Insérer les données dans la base de données (ajoutez votre logique ici)
    $query = "INSERT INTO products (name, quantity, price, img_url, description) VALUES ('$name', $quantity, $price, '$img_url', '$description')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Produit ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du produit : " . mysqli_error($conn);
    }
}
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
            <label for="name">Nom du produit:</label>
            <input type="text" id="name" name="name" required>

            <!-- Champ pour la quantité -->
            <label for="quantity">Quantité:</label>
            <input type="number" id="quantity" name="quantity" required>

            <!-- Champ pour le prix -->
            <label for="price">Prix:</label>
            <input type="text" id="price" name="price" required>

            <!-- Champ pour l'URL de l'image -->
            <label for="img_url">URL de l'image:</label>
            <input type="text" id="img_url" name="img_url" required>

            <!-- Champ pour la description -->
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" name="add_product">Ajouter le produit</button>
        </form>
    </section>

</body>

</html>