<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Hiển thị danh sách danh mục (mọi người đều xem được)
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/categories/list.php';
    }

    // Thêm danh mục (chỉ admin)
    public function add()
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Category/list');
            exit;
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống.";
            }
            if (empty($errors)) {
                $this->categoryModel->addCategory($name, $description);
                header('Location: /webbanhang/Category/list');
                exit;
            }
        }
        include 'app/views/categories/add.php';
    }

    // Sửa danh mục (chỉ admin)
    public function edit($id)
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Category/list');
            exit;
        }

        $errors = [];
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            echo "Không tìm thấy danh mục.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống.";
            }
            if (empty($errors)) {
                $this->categoryModel->editCategory($id, $name, $description);
                header('Location: /webbanhang/Category/list');
                exit;
            }
        }
        include 'app/views/categories/edit.php';
    }

    // Xóa danh mục (chỉ admin)
    public function delete($id)
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Category/list');
            exit;
        }

        $this->categoryModel->deleteCategory($id);
        header('Location: /webbanhang/Category/list');
        exit;
    }
}
?>