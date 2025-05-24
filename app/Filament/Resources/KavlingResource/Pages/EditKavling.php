<?php

namespace App\Filament\Resources\KavlingResource\Pages;

use App\Filament\Resources\KavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKavling extends EditRecord
{
    protected static string $resource = KavlingResource::class;
    protected ?string $heading = 'Edit Data Kavling';
    protected static ?string $title = 'Edit Kavling';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus'),
        ];
    }
}
