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
function addToCart($productName, $productPrice)
{
    // Vérifiez si le panier est déjà initialisé
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Cherchez le produit dans le panier et mettez à jour la quantité si nécessaire
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $productName) {
            $item['quantity']++; // Incrémentez la quantité si le produit existe déjà
            $found = true;
            break;
        }
    }

    // Si le produit n'est pas trouvé, ajoutez-le avec une quantité de 1
    if (!$found) {
        $_SESSION['cart'][] = array(
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1 // Initialisez la quantité à 1
        );
    }
}


function createOrder($ref, $date, $total, $userId, $mysqli)
{
    //  insérer une nouvelle commande
    $sql = "INSERT INTO user_order (ref, date, total, user_id) VALUES (?, ?, ?, ?)";

    // Préparer la déclaration pour l'exécution
    if ($stmt = $mysqli->prepare($sql)) {

        // Lier les paramètres et exécuter la requête
        $stmt->bind_param("ssdi", $ref, $date, $total, $userId);
        $stmt->execute();

        // Récupérer l'ID de la commande créée
        $orderId = $stmt->insert_id;

        // Fermer la déclaration
        $stmt->close();

        // Retourner l'ID de la commande créée
        return $orderId;
    } else {
        // Gérer l'erreurr si la préparation de la déclaration échoue
        echo "Erreur lors de la préparation de la requête : " . $mysqli->error;
        return false;
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
