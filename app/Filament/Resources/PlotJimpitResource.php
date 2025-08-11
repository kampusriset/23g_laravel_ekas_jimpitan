<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlotJimpitResource\Pages;
use App\Filament\Resources\PlotJimpitResource\RelationManagers;
use App\Models\PlotJimpit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class PlotJimpitResource extends Resource
{
    protected static ?string $model = PlotJimpit::class;

    
    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';
    protected static ?string $navigationLabel = 'Jadwal Plot Jimpit';

    protected static ?string $navigationGroup = 'Menu Aksi';
    protected static ?string $slug = 'jadwal-plot-jimpit';

    protected static ?string $label = 'Jadwal Plot Jimpit';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('petugas_id')
                ->label('Petugas')
                ->relationship('petugas', 'nama_lengkap')
                ->required()
                ->reactive() // ini penting, biar bisa trigger perubahan
                ->afterStateUpdated(function ($state, callable $set) {
                    // Ambil petugas berdasarkan ID terpilih
                    $petugas = \App\Models\Petugas::find($state);

                    if ($petugas) {
                        // Set status toggle sesuai status petugas
                        $set('is_active', $petugas->is_active == '1'); // atau true/false
                    }
                }),

            Select::make('nama_hari')
                ->label('Hari')
                ->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                    'Minggu' => 'Minggu',
                ])
                ->required(),

            Toggle::make('is_leader')
                ->label('Ketua Tim?')
                ->default(false),

            
        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('petugas.nama_lengkap')->label('Petugas'),
            TextColumn::make('nama_hari')->label('Jadwal Hari')->searchable(),
            IconColumn::make('is_leader')->label('Ketua')->boolean(),
            IconColumn::make('aktif_hari_ini')
                    ->label('Aktif Hari Ini')
                    ->boolean()
                    ->state(function ($record) {
                        $hariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd'); // e.g., "Kamis"
                        return strtolower($record->nama_hari) === strtolower($hariIni);
                    })
                    ->trueColor('success')
                    ->falseColor('gray'),
        ])
        ->defaultSort('nama_hari')
        ->filters([
            SelectFilter::make('nama_hari')
                ->label('Filter Hari')
                ->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                    'Minggu' => 'Minggu',
                ])
                ->searchable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlotJimpits::route('/'),
            'create' => Pages\CreatePlotJimpit::route('/create'),
            'edit' => Pages\EditPlotJimpit::route('/{record}/edit'),
        ];
    }
}
