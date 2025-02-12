<?php

namespace App\Services;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\ShoeRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class FrontService
{
    protected $categoryRepository;
    protected $shoeRepository;
    protected $brandRepository;

    public function __construct(ShoeRepositoryInterface $shoeRepository, CategoryRepositoryInterface $categoryRepository, BrandRepositoryInterface $brandRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->shoeRepository = $shoeRepository;
        $this->brandRepository = $brandRepository;
    }

    public function searchShoes(string $keyword)
    {
        return $this->shoeRepository->searchByName($keyword);
    }

    public function getFrontData()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $brands = $this->brandRepository->getAllBrands();
        $popularShoes = $this->shoeRepository->getPopularShoes(4);
        $newShoes = $this->shoeRepository->getAllNewShoes();

        return compact('categories', 'popularShoes', 'newShoes','brands');
    }
}
