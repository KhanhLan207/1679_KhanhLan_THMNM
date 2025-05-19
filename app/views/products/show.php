<?php include 'app/views/shares/header.php'; ?>
    <h1>Chi tiết sản phẩm</h1>
    <p>Tên: <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Mô tả: <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?></p>
    <p>Danh mục: <?php echo htmlspecialchars($product->category_id, ENT_QUOTES, 'UTF-8'); ?></p>
<?php if ($product->image): ?>
    <img src="/<?php echo $product->image; ?>" alt="Product Image" style="max-width: 100px;">
<?php endif; ?>
    <a href="/webbanhang/Product" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>
<?php include 'app/views/shares/footer.php'; ?>