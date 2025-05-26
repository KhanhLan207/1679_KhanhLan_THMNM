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
        <img src="/webbanhang/public/images/TBsneakers.png" alt="Logo" class="about-logo">
        <h2 class="about-title">Về TBsneakers</h2>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-flag"></i> Về TBSneakers</h3>
        <p>
            <b>TBSneakers</b> không chỉ là một cửa hàng giày – chúng tôi là nơi khơi nguồn phong cách, nơi mỗi bước đi thể hiện cá tính riêng biệt của bạn.
        </p>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-stars"></i> Sứ mệnh của chúng tôi</h3>
        <p>
            Chúng tôi mang đến cho bạn những đôi giày <b>chất lượng – thời thượng – giá tốt</b>, giúp bạn tự tin sải bước trên mọi hành trình, dù là đường phố, sân thể thao hay văn phòng.
        </p>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-gem"></i> Điều gì làm TBSneakers khác biệt?</h3>
        <ul>
            <li><b>Thiết kế độc quyền:</b> Tuyển chọn kỹ lưỡng từ thương hiệu nổi tiếng và dòng giày độc đáo khó tìm.</li>
            <li><b>Phong cách trẻ trung, năng động:</b> Sản phẩm hiện đại, phù hợp giới trẻ đam mê thể thao, thời trang và sự khác biệt.</li>
            <li><b>Giá cả hợp lý:</b> Chính sách giá minh bạch, nhiều ưu đãi hấp dẫn.</li>
            <li><b>Trải nghiệm mua sắm mượt mà:</b> Giao diện thân thiện, đặt hàng dễ dàng, giao hàng nhanh chóng.</li>
        </ul>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-heart-fill"></i> Chúng tôi dành cho ai?</h3>
        <ul>
            <li>Những bạn trẻ yêu thích sự năng động</li>
            <li>Người muốn tìm kiếm phong cách riêng</li>
            <li>Tín đồ giày thể thao, sneakers chính hiệu</li>
        </ul>
    </div>
    <div class="about-section">
        <h3><i class="bi bi-box-seam"></i> Dịch vụ của chúng tôi</h3>
        <ul>
            <li>Giao hàng toàn quốc</li>
            <li>Đổi trả linh hoạt trong 7 ngày</li>
            <li>Tư vấn chọn size và mẫu phù hợp</li>
        </ul>
    </div>
    <div class="about-quote">
        <i class="bi bi-quote"></i>
        “Một đôi giày tốt có thể thay đổi cả ngày của bạn. Một đôi giày đúng phong cách có thể thay đổi cả cuộc đời.”
    </div>
    <div class="text-center mb-3" style="font-weight:700;color:#e94560;">TBSneakers – Nâng tầm từng bước chân.</div>
    <div class="about-info">
        <i class="bi bi-person-circle"></i>
        <span><strong>Chủ cửa hàng:</strong> Trần Gia Bảo</span>
    </div>
    <div class="about-info">
        <i class="bi bi-telephone-fill"></i>
        <span><strong>Số điện thoại:</strong> 0359222640</span>
    </div>
    <div class="about-info">
        <i class="bi bi-envelope-fill"></i>
        <span><strong>Email:</strong> tgbao.16102004@gmail.com</span>
    </div>
    <div class="mt-4 text-center">
        <a href="/webbanhang/Product" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Quay lại trang chủ
        </a>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>