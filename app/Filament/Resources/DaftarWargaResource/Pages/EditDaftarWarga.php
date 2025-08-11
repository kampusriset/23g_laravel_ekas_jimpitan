<?php

namespace App\Filament\Resources\DaftarWargaResource\Pages;

use App\Filament\Resources\DaftarWargaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarWarga extends EditRecord
{
    protected static string $resource = DaftarWargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
