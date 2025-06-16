<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\TKavlingTransactionTab;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = TKavlingTransactionTab::class;
    protected static ?string $breadcrumb = "Transaksi";
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        if (isset(auth()->user()->m_user_role_tabs_id) && auth()->user()->m_user_role_tabs_id === 1) return true;
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('order_id')->label('No Order'),
            TextColumn::make('kavling.title')->label('Nama Kavling'),
            TextColumn::make('kavling.price')->label('Harga Kavling')->prefix('Rp. '),
            TextColumn::make('payment')->label('Down Payment')->prefix('Rp. '),
            TextColumn::make('status.title')->label('Status Payment')->badge()->color(fn(string $state): string => match ($state) {
                'PAID' => 'success',
                'FAILURE' => 'danger',
                'PENDING' => 'info',
                'REFUNDED' => 'warning',
            })->getStateUsing(fn($record) => $record->status ? $record->status->title : 'Tidak Ada'),
        ])
            ->filters([
                //
            ])
            ->actions([
            ActionGroup::make([
                Tables\Actions\ViewAction::make()
                    ->modalHeading('Detail Informasi Pesanan')
                    ->form([
                        Section::make('Informasi Kavling')->columns(2)->schema([
                            TextInput::make('title')->label('Kavling')->readOnly(),
                            TextInput::make('size')->label('Ukuran')->readOnly(),
                            TextInput::make('price')->label('Harga')->readOnly(),
                            Textarea::make('address')->label('Deskripsi')->readOnly(),
                            TextInput::make('down_payment')->label('Down Payment')->readOnly(),
                            Group::make([
                                TextInput::make('title')->label('Type Kavling')->readOnly()
                            ])->relationship('type')
                        ])->relationship('kavling'),
                        Section::make('Informasi Pembayaran Pelanggan')->columns(2)->schema([
                            TextInput::make('order_id')->label('No Order')->readOnly(),
                            Group::make([
                                TextInput::make('title')->label('Status pembayaran')->readOnly()
                            ])->relationship('status'),
                            TextInput::make('name')->label('Nama')->readOnly(),
                            TextInput::make('email')->label('Email')->readOnly(),
                            TextInput::make('nomor_ktp')->label('No KTP')->readOnly(),
                            TextInput::make('nomor_kk')->label('No KK')->readOnly(),
                            TextInput::make('nomor_hp')->label('No Handphone')->readOnly(),
                            TextInput::make('payment')->label('Down Payment')->readOnly(),

                        ]),
                    ]),
                // Action::make('cancelled')
                //     ->label('Un-Publish')
                //     ->action(function ($record) {
                //         $record->update([
                //             'm_status_tabs_id' => 1,
                //     ]);
                //         })
                //         ->visible(fn($record) => $record->m_status_tabs_id === 4)
                //         ->icon('heroicon-o-no-symbol')
                //         ->color('danger')
                //         ->requiresConfirmation()
                //         ->modalHeading('Un-Publish Kavling')
                //         ->modalDescription('Apakah anda yakin ingin Un-Publish Kavling ?')
                //         ->modalSubmitActionLabel('Un-Publish Sekarang')
                //         ->modalCancelAction(fn(StaticAction $action) => $action->label('Batal')),
            ])
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
