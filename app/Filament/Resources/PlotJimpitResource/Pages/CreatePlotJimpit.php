<?php

namespace App\Filament\Resources\PlotJimpitResource\Pages;

use App\Filament\Resources\PlotJimpitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CreatePlotJimpit extends CreateRecord
{
    protected static string $resource = PlotJimpitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
        $data['is_active'] = strtolower($data['nama_hari']) === strtolower($hariIni);
        return $data;

        Log::info('Hari ini: ' . $hariIni);
        Log::info('Nama Hari Input: ' . $data['nama_hari']);
        Log::info('is_active Set: ' . $data['is_active']);
    }
}
