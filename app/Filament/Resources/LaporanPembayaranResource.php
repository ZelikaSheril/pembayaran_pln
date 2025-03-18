<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanPembayaranResource\Pages;
use App\Models\LaporanPembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LaporanPembayaranResource extends Resource
{
    protected static ?string $model = LaporanPembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Laporan Pembayaran';

    protected static ?string $label = 'Laporan Pembayaran';
    
    protected static ?string $pluralLabel = 'Laporan Pembayaran';

    public static function getNavigationLabel(): string
    {
        return 'Laporan Pembayaran';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Schema form jika diperlukan
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_ref')
                    ->label('ID Pembayaran')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('idpel')
                    ->label('ID Pelanggan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->label('Jumlah Bayar')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('biaya_admin')
                    ->label('Biaya Admin')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('total_akhir')
                    ->label('Total Akhir')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->formatStateUsing(fn ($state) => ucfirst(strtolower($state)))
                    ->badge()
                    ->color(fn ($state) => $state === 'LUNAS' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),
                Tables\Columns\IconColumn::make('is_hidden')
                    ->label('Disembunyikan?')
                    ->boolean(),
            ])
            ->filters([
                Filter::make('is_hidden')
                    ->label('Hanya Data yang Disembunyikan')
                    ->query(fn (Builder $query) => $query->where('is_hidden', true)),
                SelectFilter::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->options([
                        'LUNAS' => 'Lunas',
                        'BELUM' => 'Belum Lunas',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanPembayarans::route('/'),
            'create' => Pages\CreateLaporanPembayaran::route('/create'),
            'edit' => Pages\EditLaporanPembayaran::route('/{record}/edit'),
        ];
    }

    

    
}