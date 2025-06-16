<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KavlingResource\Pages;
use App\Models\MTypeKavlingTab;
use App\Models\TKavlingTab;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KavlingResource extends Resource
{
    protected static ?string $model = TKavlingTab::class;
    protected static ?string $breadcrumb = "Kavling";
    protected static ?string $navigationLabel = 'Kavling';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Nama Kavling')->placeholder('Masukan Nama Kavling')->required(),
                Select::make('m_type_kavling_tabs_id')
                    ->label('Pilih Type')
                    ->relationship('type', 'title')
                    ->placeholder('Cari type kavling')
                    ->options(MTypeKavlingTab::all()->pluck('title', 'id'))
                    ->searchable()
                    ->required()
                    ->getSearchResultsUsing(fn(string $search): array => MTypeKavlingTab::where('title', 'like', "%{$search}%")->limit(5)->pluck('title', 'id')->toArray())
                    ->getOptionLabelUsing(fn($value): ?string => MTypeKavlingTab::find($value)?->title),
                TextInput::make('size')->label('Ukuran Kavling')->placeholder('Masukan Ukuran Kavling')->numeric()->suffix('m2')->required(),
                TextInput::make('price')->label('Harga Kavling')->placeholder('Masukan Harga Kavling')->numeric()->prefix('Rp.')->required(),
            TextInput::make('down_payment')->label('Jumlah DP')->placeholder('Masukan Jumlah DP')->numeric()->prefix('Rp.')->required(),
                Textarea::make('address')->label('Alamat Detail Kavling')->placeholder('Alamat Detail Kavling')->autosize()->required(),
                Section::make('Detail Kavling')->schema([
                    Repeater::make('description')->label('Lengkapi Deskripsi Kavling')
                        ->relationship()
                        ->schema([
                            Textarea::make('description')->label('Deskripsi Kavling')->placeholder('Deskripsi Kavling')->autosize()->required(),
                        ])
                        ->defaultItems(1)
                        ->reorderable(true)
                        ->dehydrated(true)
                        ->reorderableWithButtons()
                        ->reorderableWithDragAndDrop(true)
                        ->collapsible()
                        ->addActionLabel('Tambah Deskripsi'),
                    Repeater::make('facility')->label('Lengkapi Fasilitas Kavling')
                        ->relationship()
                        ->schema([
                            Textarea::make('description')->label('Fasilitas Kavling')->placeholder('Fasilitas Kavling')->autosize()->required(),
                        ])
                        ->defaultItems(1)
                        ->reorderable(true)
                        ->dehydrated(true)
                        ->reorderableWithButtons()
                        ->reorderableWithDragAndDrop(true)
                        ->collapsible()
                        ->addActionLabel('Tambah Fasilitas'),
                    Repeater::make('images')->label('Lengkapi Foto Kavling')
                        ->relationship()
                        ->schema([
                            FileUpload::make('path')->label('Upload Foto Kavling')
                                ->uploadingMessage('Uploading attachment...')
                                ->reorderable()
                                ->preserveFilenames()
                                ->image()
                                ->directory('foto-kavling')
                                ->maxSize(5000)->required(),
                        ])
                        ->defaultItems(1)
                        ->reorderable(true)
                        ->dehydrated(true)
                        ->reorderableWithButtons()
                        ->reorderableWithDragAndDrop(true)
                        ->collapsible()
                        ->addActionLabel('Tambah Foto'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                TKavlingTab::orderBy('id', 'desc')
            )
            ->columns([
                TextColumn::make('title')->label('Nama Kavling'),
                TextColumn::make('m_type_kavling_tabs_id')->label('type')->badge()->getStateUsing(fn($record) => $record->type ? $record->type->title : 'Tidak Ada'),
                TextColumn::make('size')->label('Ukuran')->suffix(' m2'),
                TextColumn::make('price')->label('Harga')->prefix('Rp. '),
            TextColumn::make('down_payment')->label('DP')->prefix('Rp. '),
            TextColumn::make('address')->label('Alamat')->extraHeaderAttributes([
                'class' => 'w-32'
            ])->wrap(),
                TextColumn::make('m_status_tabs_id')->label('Status')->badge()->color(fn(string $state): string => match ($state) {
                    'DRAFT' => 'gray',
                    'AKTIF' => 'success',
                    'TIDAK AKTIF' => 'danger',
                    'POSTED' => 'success',
                    'TERSEDIA' => 'success',
                    'TIDAK TERSEDIA' => 'danger',
                })->getStateUsing(fn($record) => $record->status ? $record->status->title : 'Tidak Ada'),
                TextColumn::make('m_status_tabs_transaction_id')->label('Status Kavling')->badge()->color(fn(string $state): string => match ($state) {
                    'DRAFT' => 'gray',
                    'AKTIF' => 'success',
                    'TIDAK AKTIF' => 'danger',
                    'POSTED' => 'success',
                    'TERSEDIA' => 'success',
                    'TIDAK TERSEDIA' => 'danger',
                'DIPESAN' => 'danger',
                })->getStateUsing(fn($record) => $record->status_kavling ? $record->status_kavling->title : 'Tidak Ada')

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->visible(fn($record) => $record->m_status_tabs_id === 1 || $record->m_status_tabs_id === 4),
                    Action::make('posted')
                        ->label('Publish')
                        ->action(function ($record) {
                            $record->update([
                                'm_status_tabs_id' => 4,
                            ]);
                        })
                        ->visible(fn($record) => ($record->m_status_tabs_id === 1 || $record->m_status_tabs_id === 4))
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Publish Kavling')
                        ->modalDescription('Apakah anda yakin ingin Publish Kavling ini ?')
                        ->modalSubmitActionLabel('Publish Sekarang')
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Batal')),
                    Action::make('unpublished')
                        ->label('Un-Publish')
                        ->action(function ($record) {
                            $record->update([
                                'm_status_tabs_id' => 1,
                            ]);
                        })
                        ->visible(fn($record) => $record->m_status_tabs_id === 4)
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Un-Publish Kavling')
                        ->modalDescription('Apakah anda yakin ingin Un-Publish Kavling ?')
                        ->modalSubmitActionLabel('Un-Publish Sekarang')
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Batal')),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make()->modalHeading('Hapus Kavling')
                        ->visible(fn($record) => $record->m_status_tabs_id === 1 && $record->m_status_tabs_transaction_id === 5)
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListKavlings::route('/'),
            'create' => Pages\CreateKavling::route('/create'),
            'edit' => Pages\EditKavling::route('/{record}/edit'),
        ];
    }
}
