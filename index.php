<?php
// 1. Nhúng file kết nối Database
require_once 'config.php';

// 2. GỌI FILE HTML VÀO GIAO DIỆN
include 'header.html'; 

// --- BẮT ĐẦU PHẦN LOGIC LỌC SẢN PHẨM CỦA PHP ---
$sql = "SELECT * FROM products WHERE 1=1"; 
$params = []; 

// Lọc theo danh mục (Điện thoại, Laptop, Tablet...)
if (isset($_GET['category']) && $_GET['category'] != '') {
    $sql .= " AND category = ?"; 
    $params[] = $_GET['category'];
    echo "<h2 style='text-transform: uppercase;'>Danh mục: " . htmlspecialchars($_GET['category']) . "</h2>";
} 
// Lọc theo từ khóa tìm kiếm
elseif (isset($_GET['search']) && $_GET['search'] != '') {
    $sql .= " AND name LIKE ?"; 
    $params[] = '%' . $_GET['search'] . '%';
    echo "<h2>Kết quả tìm kiếm cho: '" . htmlspecialchars($_GET['search']) . "'</h2>";
} 
// Mặc định trang chủ
else {
    echo "<h2>Sản phẩm nổi bật</h2>";
}

// Chạy lệnh lấy dữ liệu
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $row): ?>
    <div class="product-card">
        
        <img src="img/<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
        
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p class="price"><?= number_format($row['price'], 0, ',', '.') ?> đ</p>
        <p class="desc"><?= htmlspecialchars($row['description']) ?></p>
        <button>Xem chi tiết</button>
        
    </div>
<?php endforeach; ?>
    <?php else: ?>
        <p style="grid-column: span 4; color: red;">Không có sản phẩm nào phù hợp.</p>
    <?php endif; ?>
</div>

</div> 
</body>
</html>