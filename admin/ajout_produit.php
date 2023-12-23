<?php
require_once("../fonctions/product_crud.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $img_url = $_POST["img_url"];
    $description = $_POST["description"];

    // Appeler la fonction pour ajouter le produit
    $result = addProduct($name, $quantity, $price, $img_url, $description);

    if ($result) {
        echo "<br><br>Produit <strong>$name</strong> ajouté avec succès.";
    } else {
        echo "<br><br>Erreur lors de l'ajout du produit : " . mysqli_error($conn);
    }
}

// Récupérer tous les produits après l'ajout
$products = getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
        <a href="../results/acceuil.admin.php">Back to Admin Dashboard</a>
    </section>
    <!-- Ajout de produits -->
    <section>
        <h2>Ajout de produits</h2>


        <form method="post" action="ajout_produit.php">

            <label for="name">item's Name:</label>
            <input type="text" id="name" name="name" required>


            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>


            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <label for="img_url"> image's URL:</label>
            <input type="text" id="img_url" name="img_url" required>


            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" name="add_product">add product</button>
        </form>
    </section>
    <!-- Back to Admin Dashboard -->


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</body>

</html>