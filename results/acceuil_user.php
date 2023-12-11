<?php
require_once("../fonctions/product_crud.php");

// Récupérer tous les produits
$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_produit.css">
    <title>Liste des Produits</title>
</head>

<body>
    <h1>Liste des Produits</h1>

    <?php foreach ($products as $product) : ?>
        <div class="product">
            <img src="<?= $product['img_url']; ?>" alt="<?= $product['name']; ?>">
            <h2><?= $product['name']; ?></h2>
            <p>Prix: <?= $product['price']; ?></p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    <?php endforeach; ?>
</body>


</html>