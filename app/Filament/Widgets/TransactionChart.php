<?php

namespace App\Filament\Widgets;

use App\Models\ProductTransaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Transaction Amount';
    public function getDescription(): ?string
    {
        return 'Total amount of transactions made each month';
    }

    protected function getData(): array
    {
        // Fetch the total grand_total_amount for each month where is_paid is true
        $monthlyTotals = ProductTransaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(grand_total_amount) as total')
            )
            ->where('is_paid', true)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Initialize data array with 0 for each month
        $data = array_fill(1, 12, 0);

        // Fill the data array with actual totals
        foreach ($monthlyTotals as $month => $total) {
            $data[$month] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Amount',
                    'data' => array_values($data),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
