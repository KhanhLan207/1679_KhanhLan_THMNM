
<?php include 'app/views/shares/header.php'; ?>
<style>
.contact-card {
    max-width: 500px;
    margin: 60px auto 80px auto;
    border-radius: 10px;
    box-shadow: 0 6px 32px rgba(0,0,0,0.10);
    background: #fff;
    padding: 20px;
    position: relative;
}
.contact-title {
    font-weight: 800;
    color: #232946;
    margin-bottom: 28px;
    letter-spacing: 1px;
    font-size: 2rem;
}
.contact-info {
    font-size: 1.13rem;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.contact-info i {
    color: #e94560;
    font-size: 1.4em;
    margin-right: 4px;
}
.contact-card .btn-primary {
    background: #232946;
    border: none;
    border-radius: 18px;
    font-weight: 600;
    padding: 8px 28px;
    font-size: 1.08rem;
    margin-top: 10px;
    transition: background 0.2s;
}
.contact-card .btn-primary:hover {
    background: #e94560;
}
</style>
<div class="contact-card text-center">
    <div style="margin-bottom:18px;">
        <img src="/webbanhang/public/images/TraiCay.png" alt="Logo" style="height:70px;">
    </div>
    <h2 class="contact-title">Liên hệ cửa hàng GreenFruits</h2>
    <div class="contact-info">
        <i class="bi bi-person-circle"></i>
        <strong>Chủ cửa hàng:</strong> Nguyễn Khánh Lan
    </div>
    <div class="contact-info">
        <i class="bi bi-telephone-fill"></i>
        <strong>Số điện thoại:</strong> 0123456789
    </div>
    <div class="contact-info">
        <i class="bi bi-envelope-fill"></i>
        <strong>Email:</strong> nguyenkhanhlan207@gmail.com
    </div>
    <div class="contact-info">
        <i class="bi bi-geo-alt-fill"></i>
        <strong>Địa chỉ:</strong> 123, phường 456, quận 789, TP.HCM
    </div>
    <div class="mt-4">
        <a href="/webbanhang/Product" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Quay lại trang chủ
        </a>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>