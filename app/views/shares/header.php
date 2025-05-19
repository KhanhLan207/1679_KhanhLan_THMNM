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
<style>
body {
    font-family: 'Montserrat', Arial, sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
    min-height: 100vh;
}
.navbar-custom {
    background: #232946;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}
.navbar-custom .navbar-brand {
    color: #fff !important;
    font-weight: 700;
    letter-spacing: 2px;
    font-size: 1.5rem;
}
.navbar-custom .nav-link {
    color: #eebbc3 !important;
    font-weight: 500;
    margin-left: 12px;
    transition: color 0.2s;
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
    color: #232946;
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
    background: #e94560;
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
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand" href="/webbanhang/Product">
      <img src="/webbanhang/public/images/products.png" alt="Logo" style="height:100px;margin-right:8px;">
     
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
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">