<?php

namespace App\Interfaces;

interface CategoryInterface
{  
    public function getAllCategories();

    public function getCategoryById($id); 

}