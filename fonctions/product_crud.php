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

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Chercher le produit dans le panier et metter à jour la quantité si nécessaire
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $productId) {
            $item['quantity']++; // Incrémenter la quantité si le produit existe déjà
            $found = true;
            break;
        }
    }

    // Si le produit n'est pas trouvé, ajouter-le avec une quantité de 1
    if (!$found) {
        $_SESSION['cart'][] = array(
            'id' => $productId, // Assurer-vous d'inclure l'ID du produit
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1 // Initialiser la quantité à 1
        );
    }
}


// Fonction pour mettre à jour la quantité d'un produit dans le panier
function updateQuantity($index, $newQuantity)
{
    // Vérifier que la nouvelle quantité est valide
    if ($newQuantity < 1) {
        $newQuantity = 1;
    }
    $_SESSION['cart'][$index]['quantity'] = $newQuantity;
}

function recalculateItemTotal($item)
{
    return $item['quantity'] * $item['price'];
}

function removeItemFromCart($index)
{

    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}
function processPayment($user_id, $cart, $conn)
{

    $query = "INSERT INTO `orders` (user_id) VALUES (?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $order_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
    } else {

        echo "Erreur lors de la préparation de la commande : " . mysqli_error($conn);
        return false;
    }

    // Préparer la requête pour insérer les produits
    $query = "INSERT INTO order_has_product (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        foreach ($cart as $product) {

            $product_id = $product['id'];
            $quantity = $product['quantity'];
            $price = $product['price'];

            mysqli_stmt_bind_param($stmt, "iiid", $order_id, $product_id, $quantity, $price);
            if (!mysqli_stmt_execute($stmt)) {

                echo "Erreur lors de l'insertion du produit dans la commande : " . mysqli_error($conn);
                mysqli_stmt_close($stmt);
                return false;
            }
        }
        mysqli_stmt_close($stmt);
    } else {

        echo "Erreur lors de la préparation de l'insertion des produits : " . mysqli_error($conn);
        return false;
    }

    // Vider le panier après paiement réussi
    $_SESSION['cart'] = array();

    return true; // Paiement réussi
}
