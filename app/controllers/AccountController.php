<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');

class AccountController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Tạo tài khoản admin mặc định trong mã nguồn nếu chưa tồn tại
        $adminUsername = 'admin123';
        if (!$this->accountModel->getAccountByUsername($adminUsername)) {
            $adminPassword = password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 12]);
            $this->accountModel->save($adminUsername, $adminPassword, 'admin');
        }
    }

    public function register()
    {
        if (SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/product');
            exit;
        }
        $errors = [];
        include 'app/views/account/register.php';
    }

    public function save()
    {
        if (SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/product');
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->verifyCsrfToken()) {
                $errors['csrf'] = "Yêu cầu không hợp lệ.";
                include 'app/views/account/register.php';
                return;
            }

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user'; // Lấy role từ form, mặc định là user

            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập tên người dùng!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            }
            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu xác nhận không khớp!";
            }

            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['username'] = "Tên người dùng đã được đăng ký!";
            }

            if (empty($errors)) {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                if ($this->accountModel->save($username, $password, $role)) {
                    header('Location: /webbanhang/account/login');
                    exit;
                } else {
                    $errors['general'] = "Đã xảy ra lỗi khi đăng ký!";
                }
            }
        }
        include 'app/views/account/register.php';
    }

    public function login()
    {
        if (SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/product');
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->verifyCsrfToken()) {
                $errors['csrf'] = "Yêu cầu không hợp lệ.";
                include 'app/views/account/login.php';
                return;
            }

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                header('Location: /webbanhang/product');
                exit;
            } else {
                $errors['login'] = "Tên người dùng hoặc mật khẩu không đúng!";
            }
        }
        include 'app/views/account/login.php';
    }

    public function logout()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        session_unset();
        session_destroy();
        header('Location: /webbanhang/product');
        exit;
    }

    private function verifyCsrfToken()
    {
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }

    public function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}
?>