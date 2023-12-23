<!DOCTYPE html>
<html>

<head>
    <title>Paiement Réussi</title>

</head>

<body>

    <?php if (empty($_SESSION['cart'])) : ?>
        <h1>Paiement réussi et données insérées.</h1>
        <p><a href='acceuil_user.php'>Retour à l'accueil</a></p>
        <p><a href='liste_produits.php'>Voir d'autres produits</a></p>
    <?php else : ?>
        <h1>Erreur : Le panier n'a pas été vidé.</h1>
    <?php endif; ?>

</body>

</html>
<?php
session_start();
require_once("../config/connexion.php");

function calculateTotal($cart)
{
    $totalGeneral = 0.0;
    foreach ($cart as $item) {
        $totalGeneral += $item['price'] * $item['quantity'];
    }
    return $totalGeneral;
}

if (!isset($_SESSION['user_id'])) {
    die("Erreur : ID utilisateur non défini.");
}

// Supposons que $conn est votre variable de connexion établie dans le fichier inclus
$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];
$totalGeneral = calculateTotal($cart);
$date = date('Y-m-d'); // La date d'aujourd'hui
$ref = 'Une référence quelconque'; // Vous devrez générer ou obtenir cette référence

// Préparer la requête pour insérer dans la table user_order
$query = "INSERT INTO user_order (ref, date, total, user_id) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ssdi', $ref, $date, $totalGeneral, $user_id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    $order_id = mysqli_insert_id($conn);


    $_SESSION['cart'] = array(); // Vider le panier après le traitement
    // Redirection ou affichage d'un message de succès
    echo "Paiement réussi et données insérées dans user_order. ID de commande : $order_id";
} else {
    echo "Erreur lors de l'insertion de la commande : " . mysqli_error($conn);
}
$order_id = mysqli_insert_id($conn);

// Insérer les éléments du panier dans la table order_has_product
foreach ($cart as $item) {


    $product_id = $item['product_id']; // L'ID du produit doit être récupéré lorsque le produit est ajouté au panier
    $quantity = $item['quantity'];
    $price = $item['price'];

    // Insérer les détails du produit dans la table order_has_product
    $query = "INSERT INTO order_has_product (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iiid', $order_id, $product_id, $quantity, $price);
    if (!mysqli_stmt_execute($stmt)) {
        // Gérer l'erreur 
        echo "Erreur lors de l'insertion des détails de la commande pour le produit $product_id : " . mysqli_error($conn);

        break;
    }
}
$_SESSION['cart'] = array(); // Vider le panier après le traitement
echo "Paiement réussi et données insérées DANS ORDER HAS PRODUVT. ID de commande : $order_id";
//le panier se vide donc la table order has product aussi

?>