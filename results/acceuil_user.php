<?php
session_start();
require_once("../fonctions/product_crud.php");

// Récupérer tous les produits
$products = getAllProducts();

// Vérifier si le formulaire a été soumis et ajouter le produit au panier
$message = '';
if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
    addToCart($_POST['product_name'], $_POST['product_price'], $_POST['url']);
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
            <h2><?= htmlspecialchars($product['name']); ?></h2>
            <img src="<?= htmlspecialchars($product['img_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" style="width:100px; height:auto;">
            <p>Prix: <?= htmlspecialchars($product['price']); ?>€</p>
            <form action="panier.php" method="post">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="product_price" value="<?= htmlspecialchars($product['price']); ?>">
                <!-- Ajoutez un champ caché pour l'URL de l'image -->
                <input type="hidden" name="product_img_url" value="<?= htmlspecialchars($product['img_url']); ?>">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>