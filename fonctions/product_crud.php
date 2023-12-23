<?php
require_once("../config/connexion.php");

function addProduct($name, $quantity, $price, $img_url, $description)
{
    global $conn;

    $query = "INSERT INTO product (name, quantity, price, img_url, description) VALUES ('$name', $quantity, $price, '$img_url', '$description')";
    $result = mysqli_query($conn, $query);

    return $result;
}

function getAllProducts()
{
    global $conn;

    $query = "SELECT id, name, img_url, price , description FROM product";
    $result = mysqli_query($conn, $query);

    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
function addToCart($productId, $productName, $productPrice)
{
    // Vérifiez si le panier est déjà initialisé
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Cherchez le produit dans le panier et mettez à jour la quantité si nécessaire
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $productId) {
            $item['quantity']++; // Incrémentez la quantité si le produit existe déjà
            $found = true;
            break;
        }
    }

    // Si le produit n'est pas trouvé, ajoutez-le avec une quantité de 1
    if (!$found) {
        $_SESSION['cart'][] = array(
            'id' => $productId, // Assurez-vous d'inclure l'ID du produit
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1 // Initialisez la quantité à 1
        );
    }
}







// Fonction pour mettre à jour la quantité d'un produit dans le panier
function updateQuantity($index, $newQuantity)
{
    // Vérifiez que la nouvelle quantité est valide
    if ($newQuantity < 1) {
        $newQuantity = 1;
    }
    $_SESSION['cart'][$index]['quantity'] = $newQuantity;
}
// Fonction pour recalculer le prix total d'un article
function recalculateItemTotal($item)
{
    return $item['quantity'] * $item['price'];
}

function removeItemFromCart($index)
{
    // Assurez-vous que l'index est numérique et dans la plage du tableau
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}
function processPayment($user_id, $cart, $conn)
{
    // Commencez une transaction
    $conn->begin_transaction();

    try {
        // Créez une commande et obtenez l'ID de commande
        $stmt = $conn->prepare("INSERT INTO `orders` (user_id) VALUES (?)"); // Assurez-vous que la table s'appelle bien 'orders'
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // Préparez la requête pour insérer les produits
        $stmt = $conn->prepare("INSERT INTO order_has_product (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

        foreach ($cart as $product) {
            // Assurez-vous que les clés 'id', 'price' et 'quantity' existent dans $product
            $product_id = $product['id'];
            $quantity = $product['quantity'];
            $price = $product['price'];

            $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
            $stmt->execute();
        }

        // Validez la transaction
        $conn->commit();

        // Vider le panier après paiement réussi
        $_SESSION['cart'] = array();

        return true; // Paiement réussi
    } catch (Exception $e) {
        $conn->rollback();
        return false; // Paiement échoué
    }
}
