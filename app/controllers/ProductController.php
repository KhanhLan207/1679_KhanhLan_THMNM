<?php

require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/products/list.php';
    }

    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/products/list.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Hiển thị form thêm sản phẩm
    public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/products/add.php';
    }

    // Xử lý lưu sản phẩm mới
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            try {
                $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                    ? $this->uploadImage($_FILES['image'])
                    : "";
            } catch (Exception $e) {
                $errors = ['image' => $e->getMessage()];
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/products/add.php';
                return;
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/products/add.php';
            } else {
                header('Location: /webbanhang/Product');
            }
        }
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/products/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Xử lý cập nhật sản phẩm
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            try {
                $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                    ? $this->uploadImage($_FILES['image'])
                    : $_POST['existing_image'];
            } catch (Exception $e) {
                $errors = ['image' => $e->getMessage()];
                $product = $this->productModel->getProductById($id);
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/products/edit.php';
                return;
            }

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);
            if ($edit) {
                header('Location: /webbanhang/Product/');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    // Upload hình ảnh sản phẩm
    private function uploadImage($file)
    {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowedTypes)) {
            throw new Exception("Chỉ cho phép upload file ảnh JPG, JPEG, PNG, GIF.");
        }

        if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
            throw new Exception("Không thể upload file ảnh.");
        }

        return $targetFile;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($id)
    {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        header('Location: /webbanhang/Product/cart');
    }
}
