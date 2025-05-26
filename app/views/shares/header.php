<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản lý sản phẩm</title>
<link rel="stylesheet" href="/webbanhang/public/css/style.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body {
    font-family: 'Montserrat', Arial, sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #ffe0e0 100%);
    min-height: 100vh;
}
.navbar-custom {
    background:rgb(2, 98, 83);
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}
.navbar-custom .navbar-brand {
    color: #fff !important;
    font-weight: 700;
    letter-spacing: 2px;
    font-size: 1.5rem;
}
.navbar-custom .nav-link {
    color:#d8eebb !important;
    font-weight: 500;
    margin-left: 12px;
    transition: color 0.2s;
    font-size: 19px;
}
.navbar-custom .nav-link:hover {
    color: #fff !important;
}
.card {
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    background: #fff;
}
.card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 32px rgba(0,0,0,0.14);
}
.card-img-top {
    border-radius: 18px 18px 0 0;
    background: #f3f3f3;
}
.card-title {
    font-weight: 700;
    color:rgb(35, 70, 51);
}
.card-text {
    color: #232946;
}
.price-tag {
    color: #e94560;
    font-size: 1.1rem;
    font-weight: 700;
}
.btn-buy, .btn-detail {
    border-radius: 20px;
    font-weight: 600;
    padding: 6px 18px;
    margin-right: 8px;
}
.btn-buy {
    background: #0e772d;
    color: #fff;
    border: none;
}
.btn-buy:hover {
    background: #d7263d;
    color: #fff;
}
.btn-detail {
    background: #232946;
    color: #fff;
    border: none;
}
.btn-detail:hover {
    background: #121629;
    color: #fff;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom py-2">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/webbanhang/Product">
      <img src="/webbanhang/public/images/TraiCay.png" alt="Logo" style="height:100px; width: auto;">
      <span style="font-size:2rem; color:#d5eebb"> GreenFruits</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/Product">Trang chủ</a>  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/Category/list">Danh sách danh mục</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/lienhe.php">Liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/about.php">Giới thiệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/webbanhang/views/cart/Cart.php">Giỏ hàng</a>
        </li>
       
         
       
      </ul>

    </div>
  </div>
</nav>
<div class="hero-banner d-flex align-items-center justify-content-center" style="background: linear-gradient(rgba(98, 98, 101, 0.7), rgba(208, 216, 218, 0.5)), url('https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2022/10/21/3b360279-8b43-40f3-9b11-604749128187-thumb-1666321262795-16663212629521126675042.jpg') center/cover no-repeat; width:100%; height:300px;">
    <div class="w-100 text-center">
        <h1 style="font-weight:900; letter-spacing:3px; font-size:2.8rem; color:#fff; text-shadow: 0 4px 24px rgba(35,41,70,0.4), 0 2px 0 rgb(221, 240, 8);">
            CHÀO MỪNG BẠN ĐẾN VỚI <span style="color:rgb(7, 249, 172);">GreenFruits</span>
        </h1>
         <form class="d-flex" role="search" class="mt-6" style="max-width: 600px; margin: auto;" action="/webbanhang/Product/search" method="get">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
            <button type="submit">
                <i class="bi bi-search" style="color:rgb(7, 1, 7);"></i>
            </button>
          </form>
    </div>
</div>
<div class="container mt-4">