<?php

namespace App\Filament\Resources\DaftarWargaResource\Pages;

use App\Filament\Resources\DaftarWargaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDaftarWarga extends CreateRecord
{
    protected static string $resource = DaftarWargaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
