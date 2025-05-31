<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Xem danh sách sản phẩm (mọi người đều xem được)
    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/products/list.php';
    }

    // Xem chi tiết sản phẩm (mọi người đều xem được)
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/products/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Thêm sản phẩm (chỉ admin)
    public function add()
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product');
            exit;
        }

        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/products/add.php';
    }

    // Lưu sản phẩm mới (chỉ admin)
    public function save()
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            try {
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image = $this->uploadImage($_FILES['image']);
                } else {
                    $image = "";
                }
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

    // Sửa sản phẩm (chỉ admin)
    public function edit($id)
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product');
            exit;
        }

        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/products/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    // Cập nhật sản phẩm (chỉ admin)
    public function update()
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            try {
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image = $this->uploadImage($_FILES['image']);
                } else {
                    $image = $_POST['existing_image'];
                }
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

    // Xóa sản phẩm (chỉ admin)
    public function delete($id)
    {
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product');
            exit;
        }

        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    // Thêm vào giỏ hàng (chỉ user/admin đã đăng nhập)
    public function addToCart($id)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

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

    // Xem giỏ hàng (chỉ user/admin đã đăng nhập)
    public function cart()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/cart/cart.php';
    }

    // Thanh toán (chỉ user/admin đã đăng nhập)
    public function checkout()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        include 'app/views/cart/checkout.php';
    }

    // Xử lý thanh toán (chỉ user/admin đã đăng nhập)
    public function processCheckout()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            $this->db->beginTransaction();

            try {
                // Lưu thông tin đơn hàng
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                // Lưu chi tiết đơn hàng
                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                              VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                unset($_SESSION['cart']);
                $this->db->commit();
                header('Location: /webbanhang/Product/orderConfirmation');
            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    // Xác nhận đơn hàng (chỉ user/admin đã đăng nhập)
    public function orderConfirmation()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        include 'app/views/cart/orderConfirmation.php';
    }

    // Tìm kiếm sản phẩm (mọi người đều truy cập được)
    public function search()
    {
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
        $message = '';

        if ($keyword === '') {
            $products = $this->productModel->getProducts();
        } else {
            $products = $this->productModel->searchProducts($keyword);
            if (empty($products)) {
                $products = $this->productModel->getProducts();
                $message = "Không tìm thấy sản phẩm phù hợp.";
            }
        }

        include 'app/views/products/list.php';
    }

    // Cập nhật số lượng trong giỏ hàng (chỉ user/admin đã đăng nhập)
    public function updateCartQuantity()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $action = $_POST['action'];

            if (isset($_SESSION['cart'][$product_id])) {
                if ($action === 'increase') {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } elseif ($action === 'decrease' && $_SESSION['cart'][$product_id]['quantity'] > 1) {
                    $_SESSION['cart'][$product_id]['quantity']--;
                }
            }
        }

        header('Location: /webbanhang/Product/cart');
        exit;
    }

    // Xóa sản phẩm khỏi giỏ hàng (chỉ user/admin đã đăng nhập)
    public function removeFromCart()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
        }

        header('Location: /webbanhang/Product/cart');
        exit;
    }

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
}
?>