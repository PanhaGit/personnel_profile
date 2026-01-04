<?php
require_once __DIR__ . '/../service/CategoryService.php';
class CategoryController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function listCategories()
    {
        return $this->categoryService->getAllCategories();
    }

    public function viewCategory($id)
    {
        return $this->categoryService->getCategoryById($id);
    }


    public function addCategory($category_name, $status)
    {
        return $this->categoryService->createCategory($category_name, $status);
    }


    public function editCategory($category_name, $status, $id)
    {
        return $this->categoryService->updateCategory($category_name, $status, $id);
    }

    public function removeCategory($id)
    {
        return $this->categoryService->deleteCategory($id);
    }
}

?>