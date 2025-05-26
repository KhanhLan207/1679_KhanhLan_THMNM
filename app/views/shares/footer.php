</div>
<footer class="footer mt-auto py-3" style="background:rgb(2, 98, 83); color:#eebbc3;  box-shadow:0 -2px 12px rgba(0,0,0,0.07);">
        <div class="container text-center">
            <div class="mb-2">
                <a href="https://web.facebook.com/tran.gia.bao.656526" target="_blank" class="mx-2" style="color:#ff7000; text-decoration:none;">
                    <i class="bi bi-facebook" style="font-size:1.5rem;"></i>
                </a>
                <a href="mailto:tgbao.16102004@gmail.com?subject=Lien%20he%20TBsneakers" class="mx-2" style="color:#ff7000; text-decoration:none;">
                    <i class="bi bi-envelope-fill" style="font-size:1.5rem;"></i>
                </a>
                <a href="tel:0359222640" class="mx-2" style="color:#ff7000;">
                    <i class="bi bi-telephone-fill" style="font-size:1.5rem;"></i>
                </a>
            </div>
            <p class="mb-0" style="font-size:1.08rem; color :#ff7000;">&copy; 2025 GreenFruits. All rights reserved.</p>
        </div>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <?php if (isset($product) && $product->image): ?>
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