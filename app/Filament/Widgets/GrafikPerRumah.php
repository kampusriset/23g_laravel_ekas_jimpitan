<?php

namespace App\Filament\Widgets;

use App\Models\DaftarWarga;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class GrafikPerRumah extends ChartWidget
{
    protected static ?string $heading = 'Grafik Jimpitan per Rumah';
    protected static bool $isLazy = false;
    protected static ?int $sort = 2;

    use InteractsWithPageFilters;

    public function getData(): array
    {
        $wargaId = $this->filters['warga_id'] ?? null;
        $createdFrom = $this->filters['created_from'] ?? null;
        $createdUntil = $this->filters['created_until'] ?? null;

        $query = DB::table('ambil_jimpit')
            ->join('warga', 'warga.id', '=', 'ambil_jimpit.warga_id')
            ->select(DB::raw('DATE(ambil_jimpit.tanggal_ambil) as tanggal'), DB::raw('SUM(ambil_jimpit.nominal) as total'))
            ->groupBy(DB::raw('DATE(ambil_jimpit.tanggal_ambil)'))
            ->orderBy('tanggal');

        if ($wargaId) {
            $query->where('warga.id', '=', $wargaId);
        }

        if ($createdFrom) {
            $query->whereDate('ambil_jimpit.tanggal_ambil', '>=', Carbon::parse($createdFrom));
        }

        if ($createdUntil) {
            $query->whereDate('ambil_jimpit.tanggal_ambil', '<=', Carbon::parse($createdUntil));
        }

        $data = $query->get();

        return [
            'datasets' => [
                [
                    'label' => 'Nominal Jimpitan',
                    'data' => $data->pluck('total')->map(fn($v) => (float) $v)->toArray(),
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#2563eb',
                ],
            ],
            'labels' => $data->pluck('tanggal')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
