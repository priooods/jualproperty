<?php

namespace App\Filament\Resources\KavlingResource\Pages;

use App\Filament\Resources\KavlingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKavling extends CreateRecord
{
    protected static string $resource = KavlingResource::class;
    protected ?string $heading = 'Tambah Data Kavling';
    protected static ?string $title = 'Tambah Kavling';
    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['m_status_tabs_id'] = 1;
        $data['m_status_tabs_transaction_id'] = 5;
        return $data;
    }

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Data');
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('create');
    }
}
