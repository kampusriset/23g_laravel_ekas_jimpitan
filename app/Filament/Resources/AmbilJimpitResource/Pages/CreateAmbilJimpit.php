<?php

namespace App\Filament\Resources\AmbilJimpitResource\Pages;

use App\Filament\Resources\AmbilJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAmbilJimpit extends CreateRecord
{
    protected static string $resource = AmbilJimpitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
