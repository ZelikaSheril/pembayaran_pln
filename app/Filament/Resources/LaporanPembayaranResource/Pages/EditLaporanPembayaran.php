<?php

namespace App\Filament\Resources\LaporanPembayaranResource\Pages;

use App\Filament\Resources\LaporanPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPembayaran extends EditRecord
{
    protected static string $resource = LaporanPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
