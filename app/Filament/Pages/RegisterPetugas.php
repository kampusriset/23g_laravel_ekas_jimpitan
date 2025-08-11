<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register;

class RegisterPetugas extends Register
{
    public function getHeading(): string
    {
        return 'Daftar Petugas Baru';
    }

    public function getSubheading(): ?string
    {
        return 'Silakan isi form berikut untuk mendaftar.';
    }

    public function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        TextInput::make('name')
                            ->label('Username')
                            ->required(),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required(),

                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->revealable()
                            ->required(),

                        TextInput::make('passwordConfirmation')
                            ->label('Konfirmasi Kata Sandi')
                            ->password()
                            ->revealable()
                            ->required(),
                    ])
                    ->statePath('data')
            ),
        ];
    }
}
