<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetugasResource\Pages;
use App\Filament\Resources\PetugasResource\RelationManagers;
use App\Models\Petugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Auth;

class PetugasResource extends Resource
{
    protected static ?string $model = Petugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Daftar Petugas';

    protected static ?string $navigationGroup = 'Menu Aksi';
    protected static ?string $slug = 'daftar-petugas';

    protected static ?string $label = 'Daftar Petugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_lengkap')
                    ->label('Nama')
                    ->helperText('Nama harus sesuai dengan username akun petugas')
                    ->required()
                    ->maxLength(50),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'M' => 'Laki-laki',
                        'F' => 'Perempuan',
                    ])
                    ->required(),

                // Toggle::make('is_active')
                //     ->label('Status')
                //     ->default(true)
                //     ->inline(false)
                //     ->afterStateHydrated(fn($component, $state) => $component->state($state === '1'))
                //     ->dehydrateStateUsing(fn($state) => $state ? '1' : '0')
            ]);
    }

    public static function table(Table $table): Table
    {
            
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                
                
                TextColumn::make('gender')
                    ->label('Gender')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state === 'M' ? 'Laki-laki' : 'Perempuan'),

                IconColumn::make('is_active', '1')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('last_activity')
                    ->label('Last Activity')
                    ->formatStateUsing(function ($state, $record) {
                        $isActive = $record->is_active === '1';
                        $last = $record->last_activity;

                        // Kasus: belum pernah login = akun belum dibuat
                        if (!$last && !$isActive) {
                            return '👤 Akun belum dibuat';
                        }

                        if (!$last) {
                            return $isActive ? '✅ Aktif' : '❌ Nonaktif';
                        }

                        $waktu = \Carbon\Carbon::parse($last)->diffForHumans();

                        return $isActive
                            ? "✅ Login $waktu"
                            : "❌ Logout $waktu";
                    })
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPetugas::route('/'),
            'create' => Pages\CreatePetugas::route('/create'),
            'edit' => Pages\EditPetugas::route('/{record}/edit'),
        ];
    }
}
