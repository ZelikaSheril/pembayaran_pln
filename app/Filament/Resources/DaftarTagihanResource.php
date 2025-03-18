<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DaftarTagihanResource\Pages;
use App\Models\DaftarTagihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DaftarTagihanResource extends Resource
{
    protected static ?string $model = DaftarTagihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Daftar Tagihan';

    protected static ?string $label = 'Daftar Tagihan';
    
    protected static ?string $pluralLabel = 'Daftar Tagihan';

    public static function getNavigationLabel(): string
    {
        return 'Daftar Tagihan';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('idpel')
                    ->label('ID Pelanggan')
                    ->required(),

                Forms\Components\TextInput::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->disabled()
                    ->dehydrated(false)
                    ->default(fn ($get) => \App\Models\DataPelanggan::where('idpel', $get('idpel'))->value('nama')),

                Forms\Components\TextInput::make('nomor_meter')
                    ->label('Nomor Meter')
                    ->required(),

                Forms\Components\TextInput::make('bulan_tagihan')
                    ->label('Bulan Tagihan')
                    ->required(),

                Forms\Components\TextInput::make('pemakaian_kwh')
                    ->label('Pemakaian (kWh)')
                    ->required(),

                Forms\Components\TextInput::make('tarif_per_kwh')
                    ->label('Tarif/kWh')
                    ->required(),

                Forms\Components\TextInput::make('total_tagihan')
                    ->label('Total Tagihan')
                    ->required(),

                Forms\Components\Select::make('status_pembayaran')
                    ->label('Status')
                    ->options([
                        'Belum' => 'Belum Dibayar',
                        'Lunas' => 'Lunas',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('idpel')
                    ->label('ID Pelanggan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn ($record) => $record->pelanggan->nama ?? '-'),

                Tables\Columns\TextColumn::make('nomor_meter')
                    ->label('Nomor Meter')
                    ->sortable(),

                Tables\Columns\TextColumn::make('bulan_tagihan')
                    ->label('Bulan Tagihan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pemakaian_kwh')
                    ->label('Pemakaian (kWh)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tarif_per_kwh')
                    ->label('Tarif/kWh')
                    ->prefix('Rp ')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_tagihan')
                    ->label('Total Tagihan')
                    ->prefix('Rp ')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->label('Status')
                    ->colors([
                        'danger' => 'Belum',
                        'success' => 'Lunas',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'Lunas' ? 'Lunas' : 'Belum Dibayar'),
            ])
            ->filters([
                SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'Belum' => 'Belum Dibayar',
                        'Lunas' => 'Lunas',
                    ]),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->headerActions([]); // Menghapus tombol "New Daftar Tagihan"
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDaftarTagihans::route('/'),
            'edit' => Pages\EditDaftarTagihan::route('/{record}/edit'),
        ];
    }
}
