<?php
<?php
include('../php/connector.php');

$min = isset($_GET['min']) && is_numeric($_GET['min']) ? (int)$_GET['min'] : 0;
$max = isset($_GET['max']) && is_numeric($_GET['max']) ? (int)$_GET['max'] : 0;

$sql = "SELECT * FROM productdetails WHERE display_home=1";
if ($min > 0) $sql .= " AND product_price >= $min";
if ($max > 0) $sql .= " AND product_price <= $max";
$sql .= " ORDER BY Product_id DESC LIMIT 6";

$r = mysqli_query($con, $sql);
while ($data = mysqli_fetch_assoc($r)) {
?>
    <div class="recent-slide">
        <img src="<?php echo htmlspecialchars($data['product_image']); ?>" alt="Product Image" class="productlist-img" loading="lazy">
        <h3 class="product-title"><?php echo htmlspecialchars($data['product_name']); ?></h3>
        <p class="product-price">Rs <?php echo htmlspecialchars($data['product_price']); ?></p>
        <a href="productcard_afterlogin.php?productid=<?php echo $data['Product_id']; ?>">View Details</a>
    </div>
<?php } ?>