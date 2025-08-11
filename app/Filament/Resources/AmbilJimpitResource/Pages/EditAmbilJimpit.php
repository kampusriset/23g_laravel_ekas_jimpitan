<?php

namespace App\Filament\Resources\AmbilJimpitResource\Pages;

use App\Filament\Resources\AmbilJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmbilJimpit extends EditRecord
{
    protected static string $resource = AmbilJimpitResource::class;

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
