<?php

namespace App\Filament\Resources\DaftarTagihanResource\Pages;

use App\Filament\Resources\DaftarTagihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarTagihans extends ListRecords
{
    protected static string $resource = DaftarTagihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
