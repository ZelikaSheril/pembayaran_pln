<?php

namespace App\Filament\Resources\KonfirmasiPembayaranResource\Pages;

use App\Filament\Resources\KonfirmasiPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKonfirmasiPembayaran extends EditRecord
{
    protected static string $resource = KonfirmasiPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
