<?php include 'app/views/shares/header.php'; ?>
<h1>Thêm danh mục mới</h1>
<form method="POST" action="/webbanhang/Category/add">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
</form>
<a href="/webbanhang/Category/list" class="btn btn-secondary mt-2">Quay lại danh sách danh mục</a>
<?php include 'app/views/shares/footer.php'; ?>