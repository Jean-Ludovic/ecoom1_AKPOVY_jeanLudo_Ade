<?php
session_start();
require_once("../fonctions/product_crud.php");

// Récupérer tous les produits
$products = getAllProducts();

// Vérifier si le formulaire a été soumis et ajouter le produit au panier
$message = '';
if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
    addToCart($_POST['product_name'], $_POST['product_price']);
    $message = 'Le produit a été ajouté au panier.';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_produit.css">
    <title>Accueil</title>
</head>

<body>
    <h1>Liste des Produits</h1>

    <!-- Afficher un message si un produit a été ajouté -->
    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <!-- Bouton Panier -->
    <a href="./panier.php" class="big-cart-button">Panier</a>

    <!-- Liste des produits -->
    <?php foreach ($products as $product) : ?>
        <div class="product">
            <img src="<?= $product['img_url']; ?>" alt="<?= $product['name']; ?>">
            <h2><?= $product['name']; ?></h2>
            <p>Prix: <?= $product['price']; ?>€</p>
            <form action="./panier.php" method="post">
                <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
                <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>