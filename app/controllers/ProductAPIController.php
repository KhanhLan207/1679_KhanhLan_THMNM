<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
// require_once('app/utils/JWTHandler.php');

class ProductApiController
{
    private $productModel;
    private $db;
    // private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        // $this->jwtHandler = new JWTHandler(); // Khởi tạo JWTHandler
    }

    // private function authenticate()
    // {
    //     $headers = apache_request_headers();
    //     if (isset($headers['Authorization'])) {
    //         $authHeader = $headers['Authorization'];
    //         $arr = explode(" ", $authHeader);
    //         $jwt = $arr[1] ?? null;

    //         if ($jwt) {
    //             try {
    //                 $decoded = $this->jwtHandler->decode($jwt);
    //                 return $decoded ? true : false;
    //             } catch (Exception $e) {
    //                 return false;
    //             }
    //         }
    //     }
    //     return false;
    // }

    // GET /api/product
    public function list()
    {
        // if (!$this->authenticate()) {
        //     http_response_code(401);
        //     echo json_encode(['message' => 'Unauthorized']);
        //     return;
        // }

        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    // GET /api/product/{id}
    public function show($id)
    {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);

        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found']);
        }
    }

    // POST /api/product
    public function add()
    {
        // if (!$this->authenticate()) {
        //     http_response_code(401);
        //     echo json_encode(['message' => 'Unauthorized']);
        //     return;
        // }

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $category_id = $data['category_id'] ?? null;
        $image = null;

        // Ưu tiên xử lý file upload từ form-data
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            try {
                $image = $this->uploadImage($_FILES['image']);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['errors' => ['image' => $e->getMessage()]]);
                return;
            }
        } elseif (isset($data['image']) && is_string($data['image'])) {
            // Nếu gửi JSON với đường dẫn ảnh
            $image = $data['image'];
        }

        $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Product created successfully', 'image' => $image]);
        }
    }

    // PUT /api/product/{id}
    public function update($id)
    {
        // if (!$this->authenticate()) {
        //     http_response_code(401);
        //     echo json_encode(['message' => 'Unauthorized']);
        //     return;
        // }

        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $category_id = $data['category_id'] ?? null;
        $image = null;

        // Ưu tiên xử lý file upload từ form-data
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            try {
                $image = $this->uploadImage($_FILES['image']);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['errors' => ['image' => $e->getMessage()]]);
                return;
            }
        } elseif (isset($data['image']) && is_string($data['image'])) {
            // Nếu gửi JSON với đường dẫn ảnh
            $image = $data['image'];
        }

        $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

        if ($result) {
            echo json_encode(['message' => 'Product updated successfully', 'image' => $image]);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product update failed']);
        }
    }

    // DELETE /api/product/{id}
    public function delete($id)
    {
        // if (!$this->authenticate()) {
        //     http_response_code(401);
        //     echo json_encode(['message' => 'Unauthorized']);
        //     return;
        // }

        header('Content-Type: application/json');
        $result = $this->productModel->deleteProduct($id);

        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
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