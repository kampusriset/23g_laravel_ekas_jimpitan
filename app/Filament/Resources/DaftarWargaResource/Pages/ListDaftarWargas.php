<?php

namespace App\Filament\Resources\DaftarWargaResource\Pages;

use App\Filament\Resources\DaftarWargaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarWargas extends ListRecords
{
    protected static string $resource = DaftarWargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
