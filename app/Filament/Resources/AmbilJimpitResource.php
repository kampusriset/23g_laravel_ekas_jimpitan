<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmbilJimpitResource\Pages;
use App\Models\AmbilJimpit;
use App\Models\DaftarWarga;
use App\Models\PlotJimpit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;





class AmbilJimpitResource extends Resource
{
    protected static ?string $model = AmbilJimpit::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Ambil Jimpitan';
    protected static ?string $navigationGroup = 'Menu Aksi';
    protected static ?string $slug = 'ambil-jimpit';
    protected static ?string $label = 'Ambil Jimpit';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('warga_id')
                    ->label('Pemilik Rumah')
                    ->options(DaftarWarga::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('petugas_id')
                    ->label('Petugas')
                    ->options(function () {
                        return PlotJimpit::where('is_active', true)
                            ->with('petugas') // load relasi
                            ->get()
                            ->filter(fn ($plot) => $plot->petugas && $plot->petugas->nama_lengkap)
                            ->mapWithKeys(function ($plot) {
                                return [$plot->petugas->id_petugas => $plot->petugas->nama_lengkap];
                            })
                            ->unique() // supaya gak double kalau 1 petugas dipakai di banyak plot
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                DateTimePicker::make('tanggal_ambil')
                    ->label('Tanggal Ambil')
                    ->required(),

                TextInput::make('nominal')
                    ->numeric()
                    ->label('Nominal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                AmbilJimpit::query()->whereNotNull('warga_id')
            )
            ->columns([
                TextColumn::make('warga.nama')
                    ->label('Nama Warga')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('tanggal_ambil')
                    ->label('Tanggal Ambil')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('IDR', true)
                    ->sortable(),
            ])
            ->filters([
                Filter::make('tanggal_ambil')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_ambil', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_ambil', '<=', $date),
                            );
                    }),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmbilJimpits::route('/'),
            'create' => Pages\CreateAmbilJimpit::route('/create'),
            'edit' => Pages\EditAmbilJimpit::route('/{record}/edit'),
        ];
    }
}
