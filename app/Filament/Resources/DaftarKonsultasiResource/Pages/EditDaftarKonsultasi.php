<?php

namespace App\Filament\Resources\DaftarKonsultasiResource\Pages;

use App\Filament\Resources\DaftarKonsultasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarKonsultasi extends EditRecord
{
    protected static string $resource = DaftarKonsultasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
