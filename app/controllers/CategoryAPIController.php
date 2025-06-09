<?php
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';

class CategoryApiController
{
    private $db;
    private $categoryModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // GET /api/category
    public function list()
{
    header('Content-Type: application/json');
    $categories = $this->categoryModel->getCategories();
    if ($categories === false) {
        http_response_code(500);
        echo json_encode(['message' => 'Error fetching categories']);
    } else {
        echo json_encode($categories);
    }
}
}