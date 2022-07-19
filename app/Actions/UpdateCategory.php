<?php

namespace App\Actions;

use Exception;
use App\Models\Category;

class UpdateCategory
{
    private Category $category;
    private array $attributes;

    public function __construct(Category $category, array $attributes = [])
    {
        $this->category = $category;
        $this->attributes = $attributes;
    }

    public function handle(): void
    {
        $this->category->fill($this->attributes)->save();
        
    }
}
