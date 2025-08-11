<?php

namespace App\Filament\Resources\RekapJimpitHarianResource\Pages;

use App\Filament\Resources\RekapJimpitHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRekapJimpitHarian extends CreateRecord
{
    protected static string $resource = RekapJimpitHarianResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
