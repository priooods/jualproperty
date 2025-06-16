<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;
    protected ?string $heading = 'Data Transaction Kavling';
    protected static ?string $title = 'Transaction Kavling';
    protected function getHeaderActions(): array
    {
        return [];
    }
}
