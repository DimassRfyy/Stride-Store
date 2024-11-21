<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ShoeRepositoryInterface;

class FrontService
{
    protected $categoryRepository;
    protected $shoeRepository;

    public function __construct(ShoeRepositoryInterface $shoeRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->shoeRepository = $shoeRepository;
    }

    public function searchShoes(string $keyword)
    {
        return $this->shoeRepository->searchByName($keyword);
    }

    public function getFrontData()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $popularShoes = $this->shoeRepository->getPopularShoes(4);
        $newShoes = $this->shoeRepository->getAllNewShoes();

        return compact('categories', 'popularShoes', 'newShoes');
    }
}
