<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="mb-3 mb-md-0 text-center w-100" style="font-weight:900;letter-spacing:2px;font-size:2.3rem;color:#232946;">DANH SÁCH SẢN PHẨM</h1>
        <?php if (SessionHelper::isLoggedIn() && SessionHelper::isAdmin()): ?>
            <a href="/webbanhang/Product/add" class="btn btn-buy" style="white-space:nowrap;">+ Thêm sản phẩm mới</a>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['q']) && $_GET['q'] !== ''): ?>
        <h3 class="mb-4 text-center" style="color:#e94560;">
            Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($_GET['q']); ?>"
        </h3>
    <?php endif; ?>
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card h-100 w-100 shadow-sm d-flex flex-column">
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" style="text-decoration:none;">
                            <img src="/webbanhang/<?php echo $product->image; ?>" class="card-img-top" alt="Product Image" style="height:400px;object-fit:cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text mb-2" style="min-height:40px;">
                                <?php
                                    $desc = htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8');
                                    echo mb_strlen($desc) > 60 ? mb_substr($desc, 0, 60) . '...' : $desc;
                                ?>
                            </p>
                            <div class="mb-2 price-tag"><?php echo number_format($product->price, 3, ',', '.'); ?> VND</div>
                            <div class="mb-3 text-muted" style="font-size:0.98em;">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="mt-auto d-flex flex-wrap gap-2">
                                <?php if (SessionHelper::isLoggedIn() && SessionHelper::isAdmin()): ?>
                                    <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-m mb-2">Sửa</a>
                                    <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-m mb-2" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                                <?php endif; ?>
                                <?php if (SessionHelper::isLoggedIn()): ?>
                                    <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success btn-sm mb-2" title="Thêm vào giỏ">
                                        <i class="bi bi-cart-plus-fill"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">Không tìm thấy sản phẩm phù hợp.</div>
        <?php endif; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>