<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');

class AccountAPIController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        if ($this->db === null) {
            throw new Exception('Không thể kết nối đến database');
        }
        $this->accountModel = new AccountModel($this->db);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $adminUsername = 'admin123';
        if (!$this->accountModel->getAccountByUsername($adminUsername)) {
            $adminPassword = password_hash('admin123', PASSWORD_BCRYPT, ['cost' => 12]);
            $this->accountModel->save($adminUsername, $adminPassword, 'admin');
        }
    }

    public function Register()
    {
        if (SessionHelper::isLoggedIn()) {
            http_response_code(400);
            return ['status' => 'error', 'message' => 'Bạn đã đăng nhập'];
        }

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Dữ liệu JSON không hợp lệ');
            }
            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';
            $confirmPassword = $data['confirmpassword'] ?? '';
            $role = $data['role'] ?? 'user';

            $errors = [];
            if (empty($username) || strlen($username) < 4) {
                $errors['username'] = 'Tên người dùng phải có ít nhất 4 ký tự';
            }
            if (empty($password) || strlen($password) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }
            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = 'Mật khẩu xác nhận không khớp';
            }
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['username'] = 'Tên người dùng đã được đăng ký';
            }

            if (!empty($errors)) {
                http_response_code(400);
                return ['status' => 'error', 'message' => $errors];
            }

            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            if ($this->accountModel->save($username, $password, $role)) {
                http_response_code(201);
                return ['status' => 'success', 'message' => 'Đăng ký thành công'];
            }
            http_response_code(500);
            return ['status' => 'error', 'message' => 'Đăng ký thất bại'];
        } catch (Exception $e) {
            http_response_code(500);
            return ['status' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }

    public function Login()
    {
        if (SessionHelper::isLoggedIn()) {
            http_response_code(400);
            return ['status' => 'error', 'message' => 'Bạn đã đăng nhập'];
        }

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Dữ liệu JSON không hợp lệ');
            }
            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                http_response_code(200);
                return ['status' => 'success', 'message' => 'Đăng nhập thành công', 'data' => ['username' => $account->username, 'role' => $account->role]];
            }
            http_response_code(401);
            return ['status' => 'error', 'message' => 'Tên người dùng hoặc mật khẩu không đúng'];
        } catch (Exception $e) {
            http_response_code(500);
            return ['status' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }

    public function Logout()
    {
        if (!SessionHelper::isLoggedIn()) {
            http_response_code(401);
            return ['status' => 'error', 'message' => 'Bạn chưa đăng nhập'];
        }

        try {
            session_unset();
            session_destroy();
            http_response_code(200);
            return ['status' => 'success', 'message' => 'Đăng xuất thành công'];
        } catch (Exception $e) {
            http_response_code(500);
            return ['status' => 'error', 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
}
?>