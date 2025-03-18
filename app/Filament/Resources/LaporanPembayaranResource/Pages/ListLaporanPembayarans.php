<?php

namespace App\Filament\Resources\LaporanPembayaranResource\Pages;

use App\Filament\Resources\LaporanPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanPembayarans extends ListRecords
{
    protected static string $resource = LaporanPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
