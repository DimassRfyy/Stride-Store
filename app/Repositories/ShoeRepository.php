<?php

namespace App\Repositories;

use App\Models\Shoe;
use App\Repositories\Contracts\ShoeRepositoryInterface;

class ShoeRepository implements ShoeRepositoryInterface
{
    public function getPopularShoes($limit = 4) // Default limit
    {
        return Shoe::where('is_popular', true)->take($limit)->get();
    }

    public function searchByName(string $keyword)
    {
        return Shoe::where('name', 'LIKE', '%' . $keyword . '%')->get();
    }

    public function getAllNewShoes()
    {
        return Shoe::latest()->get();
    }

    public function find($id)
    {
        return Shoe::find($id);
    }

    public function getPrice($shoeId)
    {
        $shoe = $this->find($shoeId);
        return $shoe ? $shoe->price : 0;
    }
}
