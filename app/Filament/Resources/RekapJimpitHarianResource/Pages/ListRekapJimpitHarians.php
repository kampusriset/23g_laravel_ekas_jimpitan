<?php

namespace App\Filament\Resources\RekapJimpitHarianResource\Pages;

use App\Filament\Resources\RekapJimpitHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekapJimpitHarians extends ListRecords
{
    protected static string $resource = RekapJimpitHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
