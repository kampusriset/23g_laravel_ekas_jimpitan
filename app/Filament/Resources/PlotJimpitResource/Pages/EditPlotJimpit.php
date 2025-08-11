<?php

namespace App\Filament\Resources\PlotJimpitResource\Pages;

use App\Filament\Resources\PlotJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlotJimpit extends EditRecord
{
    protected static string $resource = PlotJimpitResource::class;

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
