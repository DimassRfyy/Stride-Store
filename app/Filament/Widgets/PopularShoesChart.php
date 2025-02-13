<?php

namespace App\Filament\Widgets;

use App\Models\ProductTransaction;
use App\Models\Shoe;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularShoesChart extends ChartWidget
{
    protected static ?string $heading = 'Popular Shoes Purchased';
    public function getDescription(): ?string
    {
        return 'Top 10 most popular shoes purchased';
    }
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        // Fetch the top 10 most popular shoes that are paid
        $popularShoes = ProductTransaction::select('shoe_id', DB::raw('count(*) as total'))
            ->where('is_paid', true)
            ->groupBy('shoe_id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        // Get the shoe names and their respective counts
        $labels = [];
        $data = [];
        $backgroundColors = [];
        $baseColor = [144, 238, 144]; // #90ee90

        // Find the maximum count to normalize the color intensity
        $maxCount = $popularShoes->max('total');

        foreach ($popularShoes as $transaction) {
            $shoe = Shoe::find($transaction->shoe_id);
            $labels[] = $shoe->name;
            $data[] = $transaction->total;

            // Calculate the color intensity based on popularity
            $intensity = 0.5 + (0.5 * ($transaction->total / $maxCount)); // Ensure intensity is between 0.5 and 1
            $color = array_map(function ($component) use ($intensity) {
                return (int)($component * $intensity);
            }, $baseColor);
            $backgroundColors[] = 'rgb(' . implode(',', $color) . ')';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Popular Shoes Purchased',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
