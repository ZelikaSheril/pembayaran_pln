<?php

namespace App\Filament\Resources\KonfirmasiPembayaranResource\Pages;

use App\Filament\Resources\KonfirmasiPembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKonfirmasiPembayarans extends ListRecords
{
    protected static string $resource = KonfirmasiPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
