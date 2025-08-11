<?php

namespace App\Filament\Resources\AmbilJimpitResource\Pages;

use App\Filament\Resources\AmbilJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmbilJimpits extends ListRecords
{
    protected static string $resource = AmbilJimpitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
