<?php

require_once __DIR__ . '/../model/Category.php';

class CategoryService
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function getAllCategories()
    {
        return $this->categoryModel->getAllCategories();
    }

    public function getCategoryById($id)
    {
        return $this->categoryModel->getCategoryById($id);
    }

    public function createCategory($category_name, $status)
    {
        return $this->categoryModel->createCategory($category_name, $status);
    }

    public function updateCategory($category_name, $status, $id)
    {
        return $this->categoryModel->updateCategory($category_name, $status, $id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryModel->deleteCategory($id);
    }
}
?>