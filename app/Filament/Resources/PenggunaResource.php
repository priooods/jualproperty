<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Models\MUserRoleTab;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenggunaResource extends Resource
{
    protected static ?string $model = User::class;
    
    protected static ?string $navigationGroup = 'Master';
    protected static ?string $breadcrumb = "Pengguna";
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Pengguna')->placeholder('Masukan Nama Pengguna')->required(),
                TextInput::make('email')->label('Email Pengguna')->email()->placeholder('Masukan Email Pengguna')->required(),
                TextInput::make('password')->label('Password Pengguna')->password()->placeholder('Masukan Password Pengguna')->required(),
                Select::make('m_user_role_tabs_id')
                    ->label('Pilih Role')
                    ->relationship('roles', 'title')
                    ->placeholder('Cari nama Role')
                    ->options(MUserRoleTab::whereNot('id',1)->pluck('title', 'id'))
                    ->searchable()
                    ->required()
                    ->getSearchResultsUsing(fn(string $search): array => MUserRoleTab::where('title', 'like', "%{$search}%")->limit(5)->pluck('title', 'id')->toArray())
                    ->getOptionLabelUsing(fn($value): ?string => MUserRoleTab::find($value)?->title),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                User::whereNot('m_user_role_tabs_id',1)->whereNot('id', auth()->user()->id)
            )
            ->columns([
                TextColumn::make('name')->label('Nama Pengguna'),
                TextColumn::make('email')->label('Email Pengguna'),
                TextColumn::make('m_user_role_tabs_id')->label('Role')->badge()->getStateUsing(fn($record) => $record->roles ? $record->roles->title : 'Tidak Ada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPenggunas::route('/'),
            'create' => Pages\CreatePengguna::route('/create'),
            'edit' => Pages\EditPengguna::route('/{record}/edit'),
        ];
    }
}
