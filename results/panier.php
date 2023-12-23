<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./panier_style.css">
    <title>Panier</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-general {
            font-weight: bold;
            text-align: right;
            padding-top: 20px;
        }

        .button-payer {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .button-payer:hover {
            background-color: #45a049;
        }

        .quantity-controls {
            display: flex;
            justify-content: center;
        }

        .quantity-controls button {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        .quantity-controls input {
            text-align: center;
            width: 50px;
        }

        /* Ajoutez d'autres styles spécifiques ici selon vos besoins */
    </style>
    <a href="./acceuil_user.php">RETOUR AUX COMMANDES</a>
    <?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);


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

    if (isset($_POST['action']) && $_POST['action'] == 'payer') {
        $user_id = $_SESSION['user_id']; // Obtenir l'ID de l'utilisateur de la session ou d'ailleurs
        $cart = $_SESSION['cart']; // Obtenir le panier de la session

        $paymentSuccess = processPayment($user_id, $cart, $conn);

        if ($paymentSuccess) {
            $_SESSION['cart'] = array(); // Vider le panier en cas de succès
            header("Location: paiement.php"); // Redirigez vers une page de succès
        } else {
            header("Location: error.php"); // Rediriger vers une page d'erreur
        }
        exit;
    }

    // Afficher les produits dans le panier
    $totalGeneral = 0;
    foreach ($_SESSION['cart'] as $index => $product) {
        $total = $product['price'] * $product['quantity'];
        $totalGeneral += $total;
    ?>
        <div class='product'>
            <h3>Votre Panier </h3>

            <div class='product-name'><?php echo $product['name'] . " -  " . $product['quantity'] . " - " . $product['price'] . "€ - Total: " . $total ?> €</div>

            <form action='panier.php' method='post'>
                <input type='hidden' name='item_index' value='<?php echo $index ?>'>
                <button type='submit' name='action' value='increase'>+</button>
                <input type='text' value='<?php echo $product['quantity'] ?>' readonly>
                <button type='submit' name='action' value='decrease'>-</button>
            </form>
        <?php
        echo "<form action='panier.php' method='post' style='display: inline;'>
          <input type='hidden' name='item_index' value='{$index}'>
          <input type='hidden' name='action' value='delete'>
          <button type='submit'>Supprimer</button>
        </form>";
        echo "</div>";
    }
        ?>

        <div class="payment-form-wrapper">
            <h2>Informations de Paiement</h2>
            <form action="traitemen_paiement.php" method="post">
                <div class="form-group">
                    <label for="card_name">Titulaire de la carte</label>
                    <input type="text" id="card_name" name="card_name" required placeholder="Nom sur la carte">
                </div>
                <div class="form-group">
                    <label for="card_number">Numéro de la carte</label>
                    <input type="text" id="card_number" name="card_number" required placeholder="Numéro de la carte">
                </div>
                <div class="form-group">
                    <label for="card_expiry">Date d'expiration</label>
                    <input type="text" id="card_expiry" name="card_expiry" required placeholder="MM/AA">
                </div>
                <div class="form-group">
                    <label for="card_cvv">CVV</label>
                    <input type="text" id="card_cvv" name="card_cvv" required placeholder="CVV">
            </form>
        </div>

        <?php
        // Afficher le total général
        echo "</div>";
        echo "<div class='total-general'>Total Général: {$totalGeneral}€</div>";
        echo "<form action='traitemen_paiement.php' method='post'>";
        echo "<button type='submit' class='button-payer'>Payer</button>";
        echo "</form>";
        ?>
</body>

</html>