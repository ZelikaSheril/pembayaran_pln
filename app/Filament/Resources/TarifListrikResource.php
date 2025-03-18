<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TarifListrikResource\Pages;
use App\Models\TarifListrik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;

class TarifListrikResource extends Resource
{
    protected static ?string $model = TarifListrik::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Tarif Listrik';

    protected static ?string $label = 'Tarif Listrik';
    
    protected static ?string $pluralLabel = 'Tarif Listrik';

    public static function getNavigationLabel(): string
    {
        return 'Tarif Listrik';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('golongan')
                    ->label('Golongan')
                    ->required(),

                Forms\Components\TextInput::make('daya')
                    ->label('Daya (VA)')
                    ->required(),

                Forms\Components\TextInput::make('tarif_per_kwh')
                    ->label('Tarif/KWh (Rp)')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_tarif')
                    ->label('Kode Tarif')
                    ->sortable()
                    ->getStateUsing(fn ($record) => "{$record->golongan}/{$record->daya}"),

                Tables\Columns\TextColumn::make('golongan')->label('Golongan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('daya')->label('Daya (VA)')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tarif_per_kwh')
                    ->label('Tarif/KWh (Rp)')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => rtrim(rtrim(number_format($state, 2, '.', ''), '0'), '.')),
            ])
            ->filters([
                Filter::make('golongan')
                    ->label('Golongan')
                    ->query(fn ($query, $value) => $query->where('golongan', 'like', "%$value%")),
                
                Filter::make('daya')
                    ->label('Daya (VA)')
                    ->query(fn ($query, $value) => $query->where('daya', 'like', "%$value%")),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus')->requiresConfirmation(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTarifListrik::route('/'),
            'create' => Pages\CreateTarifListrik::route('/create'),
            'edit' => Pages\EditTarifListrik::route('/{record}/edit'),
        ];
    }
}