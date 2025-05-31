<?php include 'app/views/shares/header.php'; ?>

<div class="container-fluid py-5" style="background:transparent;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg p-5" style="border-radius: 32px; max-width: 1400px; margin:auto;">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center mb-4 mb-md-0">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo $product->image; ?>" alt="Product Image" class="img-fluid" style="max-height:400px; border-radius: 24px; box-shadow:0 4px 24px rgba(0,0,0,0.10);object-fit:cover;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid" alt="No Image" style="border-radius: 24px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-3" style="font-weight:800; font-size:2.5rem; color:#232946;"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
                        <div class="mb-2">
                            <span class="price-tag" style="font-size:2rem; color:#e94560;"><?php echo number_format($product->price, 3, ',', '.'); ?> VND</span>
                        </div>
                        <div class="mb-3">
                            <strong>Danh mục:</strong>
                            <?php
                            if (isset($categories) && is_array($categories)) {
                                foreach ($categories as $cat) {
                                    if ($cat->id == $product->category_id) {
                                        echo htmlspecialchars($cat->name, ENT_QUOTES, 'UTF-8');
                                        break;
                                    }
                                }
                            } else {
                                echo htmlspecialchars($product->category_id, ENT_QUOTES, 'UTF-8');
                            }
                            ?>
                        </div>
                        <div class="mb-4">
                            <strong>Mô tả:</strong>
                            <p style="font-size:1.15rem;"><?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="/webbanhang/Product" class="btn btn-detail mr-2 mb-2">Quay lại danh sách</a>
                            <?php if (SessionHelper::isLoggedIn()): ?>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-buy mb-2" title="Thêm vào giỏ">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>