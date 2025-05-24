<?php

namespace App\Filament\Resources\KavlingResource\Pages;

use App\Filament\Resources\KavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKavlings extends ListRecords
{
    protected static string $resource = KavlingResource::class;
    protected ?string $heading = 'Tambah Data Kavling';
    protected static ?string $title = 'Tambah Kavling';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Kavling'),
        ];
    }
}
