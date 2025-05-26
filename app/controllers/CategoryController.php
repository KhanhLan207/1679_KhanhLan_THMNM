<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Hiển thị danh sách danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/categories/list.php';
    }

    // Thêm danh mục
    public function add()
    {
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

    // Sửa danh mục
    public function edit($id)
    {
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

    // Xóa danh mục
    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: /webbanhang/Category/list');
        exit;
    }
}
?>