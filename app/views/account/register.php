<?php
include 'app/views/shares/header.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$controller = new AccountController();
$csrf_token = $controller->generateCsrfToken();
?>

<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <h2 class="fw-bold mb-2 text-uppercase">Đăng ký</h2>
                    <p class="text-white-50 mb-5">Vui lòng điền thông tin để tạo tài khoản!</p>

                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $err): ?>
                                    <li><?php echo htmlspecialchars($err); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form class="user" action="/webbanhang/account/save" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Tên người dùng" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mật khẩu">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-icon-split p-3" type="submit">Đăng ký</button>
                        </div>
                    </form>

                    <div>
                        <p class="mb-0">Đã có tài khoản? <a href="/webbanhang/account/login" class="text-white-50 fw-bold">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>


<style>
    .bg-dark {
    background-color: #4ea480 !important;
}
    </style>