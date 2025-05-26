<?php include 'app/views/shares/header.php'; ?>
<style>
.about-card {
    max-width: 700px;
    margin: 60px auto 80px auto;
    border-radius: 28px;
    box-shadow: 0 6px 32px rgba(0,0,0,0.10);
    background: #fff;
    padding: 44px 36px 38px 36px;
    position: relative;
}
.about-title {
    font-weight: 900;
    color: #232946;
    margin-bottom: 22px;
    letter-spacing: 1px;
    font-size: 2.2rem;
}
.about-logo {
    height: 80px;
    margin-bottom: 18px;
}
.about-section {
    text-align: left;
    margin-bottom: 22px;
}
.about-section h3 {
    font-weight: 700;
    color: #e94560;
    margin-top: 18px;
    margin-bottom: 10px;
    font-size: 1.18rem;
    display: flex;
    align-items: center;
    gap: 7px;
}
.about-section ul {
    padding-left: 1.2em;
    margin-bottom: 0;
}
.about-section li {
    margin-bottom: 6px;
}
.about-quote {
    font-style: italic;
    color: #232946;
    background: #f8fafc;
    border-left: 4px solid #e94560;
    padding: 12px 18px;
    border-radius: 10px;
    margin: 18px 0 10px 0;
    font-size: 1.08rem;
}
.about-info {
    font-size: 1.08rem;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
}
.about-info i {
    color: #e94560;
    font-size: 1.3em;
}
.about-card .btn-primary {
    background: #232946;
    border: none;
    border-radius: 18px;
    font-weight: 600;
    padding: 8px 28px;
    font-size: 1.08rem;
    margin-top: 10px;
    transition: background 0.2s;
}
.about-card .btn-primary:hover {
    background: #e94560;
}
</style>
<div class="about-card">
    <div class="text-center">
        <img src="/webbanhang/public/images/TraiCay.png" alt="Logo" class="about-logo">
        <h2 class="about-title">Về GreenFruits</h2>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-flag"></i> Về GreenFruits</h3>
        <p>
            <b>GreenFruits</b> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error voluptate, mollitia corrupti reiciendis excepturi tempora distinctio nisi neque repellat. Aliquid consequuntur nemo voluptate expedita exercitationem laboriosam assumenda maxime ipsam autem.
        </p>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-stars"></i> Sứ mệnh của chúng tôi</h3>
        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. <b>Error voluptate, mollitia corrupti reiciendis excepturi </b>, liquid consequuntur nemo voluptate expedita exercitationem laboriosam
        </p>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-heart-fill"></i> Chúng tôi dành cho ai?</h3>
        <ul>
            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
        </ul>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-box-seam"></i> Dịch vụ của chúng tôi</h3>
        <ul>
            <li>Giao hàng toàn quốc</li>
            <li>Đổi trả linh hoạt trong 2 ngày</li>
        </ul>
    </div>
    <div class="about-quote">
        <i class="bi bi-quote"></i>
        “Lorem ipsum dolor sit, amet consectetur adipisicing elit.Error voluptate, mollitia corrupti reiciendis excepturi”
    </div>
    <div class="text-center mb-3" style="font-weight:700;color:#e94560;">GreenFruits – Nâng tầm thực phẩm sạch.</div>
    <div class="about-info">
        <i class="bi bi-person-circle"></i>
        <span><strong>Chủ cửa hàng:</strong> Nguyễn Khánh Lan</span>
    </div>
    <div class="about-info">
        <i class="bi bi-telephone-fill"></i>
        <span><strong>Số điện thoại:</strong> 0123456789</span>
    </div>
    <div class="about-info">
        <i class="bi bi-envelope-fill"></i>
        <span><strong>Email:</strong> nguyenkhanhlan207@gmail.com</span>
    </div>
    <div class="mt-4 text-center">
        <a href="/webbanhang/Product" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Quay lại trang chủ
        </a>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>