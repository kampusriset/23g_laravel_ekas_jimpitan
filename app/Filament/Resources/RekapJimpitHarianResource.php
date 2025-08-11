<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RekapJimpitHarianResource\Pages;
use App\Models\RekapJimpitHarian;
use App\Models\Petugas;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;

class RekapJimpitHarianResource extends Resource
{
    protected static ?string $model = RekapJimpitHarian::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Rekap Harian';
    protected static ?string $navigationGroup = 'Menu Laporan';
    protected static ?string $slug = 'rekap-jimpit-harian';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Select::make('petugas_id')
                    ->label('Petugas')
                    ->options(
                        Petugas::where('is_active', '1')
                            ->pluck('nama_lengkap', 'id_petugas')
                    )
                    ->searchable()
                    ->required(),

                DateTimePicker::make('tanggal_rekap')
                    ->label('Tanggal Rekap')
                    ->required()
                    ->live() // biar bisa trigger perubahan
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $tanggal = \Carbon\Carbon::parse($state)->format('Y-m-d');

                        $total = DB::table('ambil_jimpit')
                            ->whereDate('tanggal_ambil', $tanggal)
                            ->sum('nominal');

                        $set('nominal', $total);
                    }),

                TextInput::make('nominal')
                    ->helperText('Otomatis terisi dari total ambil jimpit warga pada tanggal ini')
                    ->label('Nominal Total Jimpit Warga')
                    ->numeric()
                    ->readOnly()
                    ->required(),
                    
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('petugas.nama_lengkap')
                ->label('Petugas')
                ->searchable()
                ->sortable()
                ->copyable(),

                TextColumn::make('tanggal_rekap')->label('Tanggal')->dateTime(),
                TextColumn::make('nominal')
                ->money('IDR', true)
                ->searchable()
                ->sortable()
                ->copyable(),

                TextColumn::make('created_at')->label('Dibuat')->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekapJimpitHarians::route('/'),
            'create' => Pages\CreateRekapJimpitHarian::route('/create'),
            'edit' => Pages\EditRekapJimpitHarian::route('/{record}/edit'),
        ];
    }
}

