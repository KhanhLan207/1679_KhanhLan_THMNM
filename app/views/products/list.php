<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0" style="font-weight:700;letter-spacing:2px;">DANH SÁCH SẢN PHẨM</h1>
        <a href="/webbanhang/Product/add" class="btn btn-buy">+ Thêm sản phẩm mới</a>
    </div>
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <?php if ($product->image): ?>
                <img src="/webbanhang/<?php echo $product->image; ?>" class="card-img-top" alt="Product Image" style="height:220px;object-fit:cover;">
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-2"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h5>
                    <p class="card-text mb-2" style="min-height:40px;"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    <div class="mb-2 price-tag"><?php echo number_format($product->price, 0, ',', '.'); ?> VND</div>
                    <div class="mb-3 text-muted" style="font-size:0.95em;">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="mt-auto">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="btn btn-detail btn-sm">Xem chi tiết</a>
                        <a href="#" class="btn btn-buy btn-sm">Thêm vào giỏ</a>
                        <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>