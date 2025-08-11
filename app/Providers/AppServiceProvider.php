<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\UpdatePetugasStatus;
use App\Models\Petugas;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Logout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            
            $user = $event->user;
            $nama = $user->name;

            $petugas = \App\Models\Petugas::whereRaw('LOWER(nama_lengkap) = ?', [strtolower($nama)])->first();

            if ($petugas) {
                Log::info("Sebelum update: " . $petugas->is_active);

                
                $petugas->update([
                'is_active' => '1',
                'last_activity' => now(),
            ]);

                Log::info("Sesudah update: " . $petugas->fresh()->is_active);
            } else {
                Log::warning('Petugas tidak ditemukan untuk user: ' . $nama);
            }
        });

        Event::listen(Logout::class, function ($event) {
            $user = $event->user;

            // Cek kalau user masih valid
            if ($user && isset($user->name)) {
                $nama = $user->name;

                $petugas = Petugas::whereRaw('LOWER(nama_lengkap) = ?', [strtolower($nama)])->first();

                if ($petugas) {
                    $petugas->update([
                        'is_active' => '0',
                        'last_activity' => now(),
                    ]);

                    Log::info("Petugas dinonaktifkan saat logout: $nama");
                } else {
                    Log::warning("Logout - Petugas tidak ditemukan untuk user: $nama");
                }
            }
        });

    }

    
}
