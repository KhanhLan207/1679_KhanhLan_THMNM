<?php
class AccountModel
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Lỗi truy vấn getAccountByUsername: " . $e->getMessage();
            return null;
        }
    }

    public function save($username, $password, $role = "user")
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role, created_at) 
                  VALUES (:username, :password, :role, NOW())";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $role = htmlspecialchars(strip_tags($role));

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        try {
            $result = $stmt->execute();
            if ($result) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Lưu dữ liệu thất bại: " . print_r($errorInfo, true));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Lỗi PDO khi lưu: " . $e->getMessage());
            return false;
        }
    }
}
?>