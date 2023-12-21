<?php
session_start();
require_once("../fonctions/product_crud.php");

// Initialiser le total général
$totalGeneral = 0;
foreach ($_SESSION['cart'] as &$item) {
    if (!isset($item['quantity'])) {
        $item['quantity'] = 1; //  chaque produit a une quantité
    }
}
if (isset($_POST['change_quantity'])) {
    $index = $_POST['item_index'];
    $newQuantity = $_SESSION['cart'][$index]['quantity'];

    if ($_POST['change_quantity'] === 'increase') {
        $newQuantity++;
    } elseif ($_POST['change_quantity'] === 'decrease') {
        $newQuantity--;
    }

    updateQuantity($index, $newQuantity);
}

// Initialiser le total général
$totalGeneral = 0;

// Calculer le total général
foreach ($_SESSION['cart'] as $item) {
    $totalGeneral += recalculateItemTotal($item);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./panier_style.css">
    <title>Panier</title>
</head>

<body>
    <h1>Votre Panier</h1>

    <table>
        <thead>
            <tr>
                <th>Article</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Prix Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>
                        <form action="panier.php" method="post">
                            <button type="submit" name="change_quantity" value="decrease">-</button>
                            <input type="text" name="product_quantity" value="<?= $item['quantity'] ?>" readonly>
                            <button type="submit" name="change_quantity" value="increase">+</button>
                            <input type="hidden" name="item_index" value="<?= $index ?>">
                        </form>
                    </td>
                    <td><?= htmlspecialchars($item['price']) ?>€</td>
                    <td><?= htmlspecialchars(recalculateItemTotal($item)) ?>€</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Général</th>
                <th><?= htmlspecialchars($totalGeneral) ?>€</th> <!-- Sécuriser la sortie -->
            </tr>
        </tfoot>
    </table>

    <div class="checkout">
        <button onclick="location.href='paiement.php'" class="pay-button">Payer</button>
    </div>
</body>

</html>