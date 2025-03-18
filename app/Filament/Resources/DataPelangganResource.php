<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPelangganResource\Pages;
use App\Models\DataPelanggan;
use App\Models\TarifListrik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataPelangganResource extends Resource
{
    protected static ?string $model = DataPelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Pelanggan';

    protected static ?string $label = 'Data Pelanggan';
    
    protected static ?string $pluralLabel = 'Data Pelanggan';

    public static function getNavigationLabel(): string
    {
        return 'Data Pelanggan';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('idpel')
                    ->label('ID Pelanggan')
                    ->required()
                    ->unique()
                    ->maxLength(12),

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Pelanggan')
                    ->required(),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->required(),

                Forms\Components\TextInput::make('no_telepon')
                    ->label('No. Telepon')
                    ->tel()
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->nullable(),

                Forms\Components\TextInput::make('nomor_meter')
                    ->label('Nomor Meter')
                    ->required()
                    ->unique(),

                Forms\Components\Select::make('daya')
                    ->label('Daya (VA)')
                    ->options(TarifListrik::pluck('daya', 'daya'))
                    ->required(),

                Forms\Components\Select::make('jenis_meteran')
                    ->label('Jenis Meteran')
                    ->options([
                        'Prabayar' => 'Prabayar',
                        'Pascabayar' => 'Pascabayar',
                    ])
                    ->required(),

                Forms\Components\Select::make('jenis_tarif')
                    ->label('Jenis Tarif')
                    ->options(TarifListrik::pluck('golongan', 'golongan'))
                    ->required(),

                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->unique()
                    ->required()
                    ->maxLength(16),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->label('No')->rowIndex(),
            Tables\Columns\TextColumn::make('idpel')->label('ID Pelanggan')->sortable(),
            Tables\Columns\TextColumn::make('nama')->label('Nama')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('alamat')->label('Alamat')->limit(50),
            Tables\Columns\TextColumn::make('no_telepon')->label('No. Telepon'),
            Tables\Columns\TextColumn::make('email')->label('Email')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nomor_meter')->label('Nomor Meter'),
            Tables\Columns\TextColumn::make('daya')->label('Daya (VA)')->sortable(),
            Tables\Columns\TextColumn::make('jenis_meteran')->label('Jenis Meteran'),
            Tables\Columns\TextColumn::make('jenis_tarif')->label('Jenis Tarif'),
            Tables\Columns\TextColumn::make('nik')->label('NIK'),
            Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('jenis_meteran')
                ->label('Jenis Meteran')
                ->options([
                    'Prabayar' => 'Prabayar',
                    'Pascabayar' => 'Pascabayar',
                ]),

            Tables\Filters\SelectFilter::make('daya')
                ->label('Daya (VA)')
                ->options(TarifListrik::pluck('daya', 'daya')->toArray()),

            Tables\Filters\SelectFilter::make('jenis_tarif')
                ->label('Jenis Tarif')
                ->options(TarifListrik::pluck('golongan', 'golongan')->toArray()),
        ])
        ->actions([
            Tables\Actions\EditAction::make()->label('Edit'),
            Tables\Actions\DeleteAction::make()->label('Hapus')->requiresConfirmation(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    
    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPelanggan::route('/'),
            'create' => Pages\CreateDataPelanggan::route('/create'),
            'edit' => Pages\EditDataPelanggan::route('/{record}/edit'),
        ];
    }
}
