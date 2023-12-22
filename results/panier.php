<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./panier_style.css">
    <title>Panier</title>
</head>

<body>
    <a href="./acceuil_user.php">RETOUR AUX COMMANDES</a>
    <?php

    session_start();
    require_once("../fonctions/product_crud.php");
    // Ajouter un produit au panier
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        // Vérifier si le produit est déjà dans le panier
        $product_found = false;
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i]['name'] == $product_name) {
                $_SESSION['cart'][$i]['quantity']++;
                $product_found = true;
                break;
            }
        }
        // Si le produit n'est pas trouvé, l'ajouter au panier
        if (!$product_found) {
            $_SESSION['cart'][] = array('name' => $product_name, 'price' => $product_price, 'quantity' => 1);
        }
    }

    // Gérer l'augmentation et la réduction de la quantité
    if (isset($_POST['action'])) {
        $index = $_POST['item_index'] ?? null; // Utilisez ?? pour définir null si 'item_index' n'est pas défini.
        if ($index !== null) {
            switch ($_POST['action']) {
                case 'increase':
                    $_SESSION['cart'][$index]['quantity']++;
                    break;
                case 'decrease':
                    if ($_SESSION['cart'][$index]['quantity'] > 1) {
                        $_SESSION['cart'][$index]['quantity']--;
                    }
                    break;
                case 'delete':
                    removeItemFromCart($index);
                    break;
                case 'add':
                    $product_name = $_POST['product_name'];
                    $product_price = $_POST['product_price'];
                    $product_found = false;
                    foreach ($_SESSION['cart'] as $i => $item) {
                        if ($item['name'] === $product_name) {
                            $_SESSION['cart'][$i]['quantity']++;
                            $product_found = true;
                            break;
                        }
                    }
                    if (!$product_found) {
                        $_SESSION['cart'][] = array('name' => $product_name, 'price' => $product_price, 'quantity' => 1);
                    }
                    break;
            }
        }

        // Redirection après l'exécution de l'action
        header('Location: panier.php');
        exit;
    }

    // Afficher les produits dans le panier
    $totalGeneral = 0;
    foreach ($_SESSION['cart'] as $index => $product) {
        $total = $product['price'] * $product['quantity'];
        $totalGeneral += $total;
        echo "<div class='product'>";
        echo "<div class='product-name'>{$product['name']} - {$product['quantity']} - {$product['price']}€ - Total: {$total}€</div>";
        // Boutons pour modifier la quantité
        echo "<form action='panier.php' method='post'>
            <input type='hidden' name='item_index' value='{$index}'>
            <button type='submit' name='action' value='increase'>+</button>
            <input type='text' value='{$product['quantity']}' readonly>
            <button type='submit' name='action' value='decrease'>-</button>
          </form>";

        echo "<form action='panier.php' method='post' style='display: inline;'>
          <input type='hidden' name='item_index' value='{$index}'>
          <input type='hidden' name='action' value='delete'>
          <button type='submit'>Supprimer</button>
        </form>";
        echo "</div>";
    }



    // Afficher le total général
    echo "</div>";
    echo "<div class='total-general'>Total Général: {$totalGeneral}€</div>";
    ?>
</body>

</html>