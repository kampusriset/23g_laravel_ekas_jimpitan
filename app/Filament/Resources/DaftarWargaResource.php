<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarWargaResource\Pages;
use App\Filament\Resources\DaftarWargaResource\RelationManagers;
use App\Models\DaftarWarga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class DaftarWargaResource extends Resource
{
    protected static ?string $model = DaftarWarga::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Daftar Warga';

    protected static ?string $navigationGroup = 'Menu Aksi';
    protected static ?string $slug = 'daftar-warga';

    protected static ?string $label = 'Daftar Warga';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Warga')
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_rumah')
                    ->label('Nomor Rumah')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Warga')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_rumah')
                    ->label('Nomor Rumah')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListDaftarWargas::route('/'),
            'create' => Pages\CreateDaftarWarga::route('/create'),
            'edit' => Pages\EditDaftarWarga::route('/{record}/edit'),
        ];
    }
}
