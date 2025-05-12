<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Nhúng Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #5c5c5c;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin-top: 50px;
        }
        h1 {
            color:rgb(12, 14, 18);
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-success {
            color:rgb(12, 14, 18);
            background-color: #86efac;
            border-color: #86efac;
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #4ade80;
            border-color: #4ade80;
        }
        .btn-warning {
            background-color: #fcd34d;
            border-color: #fcd34d;
            border-radius: 8px;
            color: #374151;
        }
        .btn-warning:hover {
            background-color: #fbbf24;
            border-color: #fbbf24;
        }
        .btn-danger {
            background-color: #f87171;
            border-color: #f87171;
            border-radius: 8px;
        }
        .btn-danger:hover {
            background-color: #ef4444;
            border-color: #ef4444;
        }
        .table {
            background-color: #fef8f8;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background-color: #e2e8f0;
            color: #6b7280;
            font-weight: 500;
        }
        .table td {
            vertical-align: middle;
        }
        .alert-info {
            background-color: #bfdbfe;
            border-color: #93c5fd;
            color: #1e40af;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Danh sách sản phẩm</h1>
        <a href="/project1/Product/add" class="btn btn-success mb-3">Thêm sản phẩm mới</a>
        <?php if (empty($products)): ?>
            <div class="alert alert-info">Chưa có sản phẩm nào.</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/project1/Product/edit/<?php echo $product->getID(); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="/project1/Product/delete/<?php echo $product->getID(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <!-- Nhúng Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>