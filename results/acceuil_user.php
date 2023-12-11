<?php
require_once("product_functions.php");

// Récupérer tous les produits
$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Utilisateur</title>
</head>

<body>
    <h2>Liste des produits</h2>

    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?php echo $product['name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Autres éléments de la page acceuil_user.php -->
</body>

</html>