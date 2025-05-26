<?php include 'app/views/shares/header.php'; ?>
<h1>Giỏ hàng</h1>
<?php if (!empty($cart)): ?>
    <table class="table">
        <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $totalPrice = 0; // Biến để tính tổng tiền
        foreach ($cart as $id => $item): 
            $itemTotal = $item['price'] * $item['quantity']; // Tổng tiền cho từng sản phẩm
            $totalPrice += $itemTotal; // Cộng vào tổng tiền
        ?>
            <tr>
                <td><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8') ?> VND</td>
                <td>
                    <form action="/webbanhang/Product/updateCartQuantity" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="action" value="decrease">
                        <button type="submit" class="cart-qty-btn">-</button>
                    </form>
                    <?= htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8') ?>
                    <form action="/webbanhang/Product/updateCartQuantity" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="action" value="increase">
                        <button type="submit" class="cart-qty-btn">+</button>
                    </form>
                </td>
                <td><?= htmlspecialchars($itemTotal, ENT_QUOTES, 'UTF-8') ?> VND</td>
                <td>
                    <form action="/webbanhang/Product/removeFromCart" method="post" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right font-weight-bold">Tổng tiền:</td>
                <td class="font-weight-bold"><?= htmlspecialchars($totalPrice, ENT_QUOTES, 'UTF-8') ?> VND</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>
<a href="/webbanhang/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
<a href="/webbanhang/Product/checkout" class="btn btn-secondary mt-2">Thanh Toán</a>
<?php include 'app/views/shares/footer.php'; ?>