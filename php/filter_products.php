<?php
include('../php/connector.php'); // Include your database connection

$category = $_POST['category'] ?? '';
$minPrice = $_POST['minPrice'] ?? '';
$maxPrice = $_POST['maxPrice'] ?? '';

$query = "SELECT * FROM productdetails WHERE display_home = 1";
$params = [];
$types = "";

if (!empty($category)) {
    $query .= " AND category_name = ?";
    $params[] = $category;
    $types .= "s";
}
if (!empty($minPrice) && is_numeric($minPrice)) {
    $query .= " AND product_price >= ?";
    $params[] = $minPrice;
    $types .= "d";
}
if (!empty($maxPrice) && is_numeric($maxPrice)) {
    $query .= " AND product_price <= ?";
    $params[] = $maxPrice;
    $types .= "d";
}

$stmt = $con->prepare($query . " ORDER BY Product_id DESC");
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $productid = $data['Product_id'];
        $imgPath = (strpos($data['product_image'], '../') === 0) ? $data['product_image'] : '../' . $data['product_image'];
        ?>
        <div class="product-item">
            <div style="width:100%; height:65%">
                <img src="<?= htmlspecialchars($imgPath) ?>" alt="databaseimage" class="productlist-img">
            </div>
            <div style="margin-top:10px;">
                <h3 class="product-title"><?= htmlspecialchars($data['product_name']) ?></h3>
                <p class="product-price">Rs <?= htmlspecialchars($data['product_price']) ?></p>
                <a href="productcard_afterlogin.php?productid=<?= urlencode($productid) ?>">Buy now</a>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No products found with the selected filters.</p>";
}
?>
