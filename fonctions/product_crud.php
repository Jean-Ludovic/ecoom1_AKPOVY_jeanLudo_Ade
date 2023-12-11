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

    $query = "SELECT * FROM product";
    $result = mysqli_query($conn, $query);

    $products = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}
