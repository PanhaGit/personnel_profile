<?php

require_once __DIR__ . '/../core/Database.php';

class Category extends Database
{
    public function __construct()
    {
        Database::getConnection();
    }

    public function getAllCategories()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategoryById($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function createCategory($category_name, $status)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO categories (category_name, status) VALUES (:category_name, :status)");
        $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function updateCategory($category_name, $status, $id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE categories SET category_name = :category_name, status = :status WHERE id = :id");
        $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function deleteCategory($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>