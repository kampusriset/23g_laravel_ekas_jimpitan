<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Components\Select;
use App\Models\DaftarWarga;
use App\Filament\Widgets\JadwalPetugas;


class Dashboard extends BaseDashboard
{
    use HasFiltersForm;
    
    public function filtersForm(Form $form): Form

    
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                            Select::make('warga_id')
                                ->label('Nama Warga')
                                ->options(DaftarWarga::all()->pluck('nama', 'id'))
                                ->searchable()
                                ->required(),
                            
                            DatePicker::make('created_from')->label('Dari Tanggal'),
                            DatePicker::make('created_until')->label('Sampai Tanggal'),
                        ])
                        ->columns(3)
                        
                ]);
        }

        

        
        

}