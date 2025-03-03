<?php
include '../connection.php'; // Include database connection

if (isset($_POST["query"])) {
    $search = "%" . $_POST["query"] . "%";
    if (isset($_COOKIE["selectedProducts"])) {
        $cookieproduct = $_COOKIE["selectedProducts"];
        $cookieproduct = json_decode($_COOKIE['selectedProducts'], true);
    } else {
        $cookieproduct = [];
    }
    $query = $conn->prepare("SELECT id, product_name FROM products WHERE product_name LIKE :search LIMIT 10");
    $query->bindParam(":search", $search, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        echo '<table class="table table-bordered"><tr><th>Select</th><th>id</th><th>Product Name</th>
        </tr>';
        foreach ($products as $product) {
            echo '<tr><td><input type="checkbox" name="productid[]" class="product-checkbox" value="' . htmlspecialchars($product["id"]) . '"';
            if (in_array($product["id"], $cookieproduct)) {
                echo "checked";
            }
            echo '></td>
            <td >' . htmlspecialchars($product["id"]) . '</td>
            <td >' . htmlspecialchars($product["product_name"]) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }
}
