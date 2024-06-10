<?php
class MovieCategoryModel
{
    private int $categoryID;
    private string $category;

    public function __construct($categoryID, $category)
    {
        $this->categoryID = $categoryID;
        $this->category = $category;
    }

    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}