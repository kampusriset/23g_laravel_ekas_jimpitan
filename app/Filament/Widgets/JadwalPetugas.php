<?php

namespace App\Filament\Widgets;

use App\Models\Jadwal;
use App\Models\PlotJimpit;
use Filament\Widgets\TableWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class JadwalPetugas extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static bool $isLazy = false;
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\PlotJimpit::query()->with('petugas'))
            ->columns([
                Tables\Columns\TextColumn::make('petugas.nama_lengkap')->label('Nama Petugas'),
                Tables\Columns\TextColumn::make('nama_hari')->label('Hari'),
            ]);
    }
}
