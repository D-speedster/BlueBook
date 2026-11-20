<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalStock = Product::sum('stock');
        $totalValue = Product::sum('price');
        $categories = Category::where('is_active', true)->count();
        
        return [
            Stat::make('کل محصولات', $totalProducts)
                ->description($activeProducts . ' محصول فعال')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('موجودی کل', number_format($totalStock))
                ->description('واحد در انبار')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
                
            Stat::make('ارزش کل', number_format($totalValue))
                ->description('ریال')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('info'),
                
            Stat::make('دسته‌بندی‌ها', $categories)
                ->description('دسته فعال')
                ->descriptionIcon('heroicon-m-folder')
                ->color('primary'),
        ];
    }
}
