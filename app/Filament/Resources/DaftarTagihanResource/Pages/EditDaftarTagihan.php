<?php

namespace App\Filament\Resources\DaftarTagihanResource\Pages;

use App\Filament\Resources\DaftarTagihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarTagihan extends EditRecord
{
    protected static string $resource = DaftarTagihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
