<?php

namespace App\Filament\Resources\PlotJimpitResource\Pages;

use App\Filament\Resources\PlotJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlotJimpits extends ListRecords
{
    protected static string $resource = PlotJimpitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
