<?php

namespace App\Filament\Resources\RekapJimpitHarianResource\Pages;

use App\Filament\Resources\RekapJimpitHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekapJimpitHarian extends EditRecord
{
    protected static string $resource = RekapJimpitHarianResource::class;

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
