<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarKonsultasiResource\Pages;
use App\Models\Konsultasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;

class DaftarKonsultasiResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Konsultasi';

    protected static ?string $label = 'Daftar Konsultasi';
    
    protected static ?string $pluralLabel = 'Daftar Konsultasi';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                Forms\Components\Textarea::make('pesan')
                    ->label('Pesan/Kendala')
                    ->required()
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pesan')->label('Pesan/Kendala')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dikirim Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                // Filter berdasarkan tanggal pengiriman
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('to')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['to'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()->label('Hapus')->requiresConfirmation(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDaftarKonsultasis::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Daftar Konsultasi';
    }
}
