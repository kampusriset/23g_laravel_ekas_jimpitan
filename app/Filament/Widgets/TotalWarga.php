<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DaftarWarga; 


class TotalWarga extends BaseWidget
{   
    protected static ?int $sort = 1;
    protected static bool $isLazy = false;
    protected function getStats(): array
    
    


    {
        $totalWarga = DaftarWarga::count(); 

        return [
            Stat::make(label: 'Total Warga', value: $totalWarga)
        ];
    }
}

