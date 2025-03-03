<?php
include '../connection.php'; // Include database connection

if (isset($_COOKIE["selectedProducts"])) {
    $cookieproduct = $_COOKIE["selectedProducts"];
    $cookieproduct = json_decode($_COOKIE['selectedProducts'], true);
    echo '<table class="table table-bordered">';
    echo "<thead>";
    echo "<th>ID</th>";
    echo "<th>Product Name</th>";
    echo "</thead>";
    foreach ($cookieproduct as $cpdid) {
        $query = $conn->prepare("SELECT * FROM products WHERE id=$cpdid");
        $query->execute();
        $products = $query->fetchAll();
        foreach ($products as $pd) {
            echo "<tr>";
            echo '<td>' . $pd["id"] . '</td>';
            echo '<td>' . $pd["product_name"] . '</td>';
            echo "<tr>";
        }
    }
    echo "</table>";
}
