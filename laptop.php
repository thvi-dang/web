<?php
require_once 'config.php';
include 'header.html'; // Kết nối menu, thanh tìm kiếm và mở thẻ <div class="container">
?>

    <h2 style="text-align: center; color: #0056b3; margin-bottom: 20px; text-transform: uppercase;">
       Thế Giới Laptop
    </h2>

    <div class="product-grid"> 
        <?php
        // Lệnh SQL chỉ lấy sản phẩm thuộc danh mục 'laptop'
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category ='laptop' ORDER BY id DESC");
        $stmt->execute();
        $dienthoai = $stmt->fetchAll();

        if ($dienthoai): 
            foreach ($dienthoai as $row): 
        ?>
                
                <div class="product-card">
                    <img src="img/<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p class="price"><?= number_format($row['price'], 0, ',', '.') ?> đ</p>
                    <p class="desc"><?= htmlspecialchars($row['description']) ?></p>
                    <button>Mua ngay</button>
                </div>

        <?php 
            endforeach; 
        else: 
        ?>
            <p style="grid-column: 1 / -1; text-align: center; color: red;">Hiện chưa laptop nào.</p>
        <?php endif; ?>
    </div>

</div> </body>
</html>