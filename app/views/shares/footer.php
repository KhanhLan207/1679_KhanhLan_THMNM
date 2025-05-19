</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script
src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js">
</script>
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        // Nếu không chọn file mới, giữ nguyên ảnh cũ (nếu có)
        <?php if ($product->image): ?>
        preview.src = "/webbanhang/<?php echo $product->image; ?>";
        preview.style.display = 'block';
        <?php else: ?>
        preview.src = "#";
        preview.style.display = 'none';
        <?php endif; ?>
    }
}
</script>
</body>
</html>