<?php include 'app/views/shares/header.php'; ?>
<h1>Danh sách danh mục</h1>
<?php if (SessionHelper::isLoggedIn() && SessionHelper::isAdmin()): ?>
    <a href="/webbanhang/Category/add" class="btn btn-success mb-2">Thêm danh mục mới</a>
<?php endif; ?>
<ul class="list-group">
<?php foreach ($categories as $category): ?>
    <li class="list-group-item">
        <h2><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></h2>
        <p><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php if (SessionHelper::isLoggedIn() && SessionHelper::isAdmin()): ?>
            <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>" class="btn btn-warning">Sửa</a>
            <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
<?php include 'app/views/shares/footer.php'; ?>