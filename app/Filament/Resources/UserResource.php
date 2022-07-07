<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema(self::makeFormSchema());
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns(self::makeTableColumns())
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\TernaryFilter::make('email_verified_at')
                    ->label('Verified EMail')
                    ->placeholder('All Users')
                    ->trueLabel('Only Verified Users')
                    ->falseLabel('Only Unverified records')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('users.email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('users.email_verified_at'),
                    )
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getRelations() : array
    {
        return [
            RelationManagers\SnippetsRelationManager::class,
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    private static function makeFormSchema() : array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\DateTimePicker::make('email_verified_at'),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                // Required if instance of CreateRecord
                ->required(fn($livewire) => $livewire instanceof CreateRecord)
                // Check if must dehydrate (not null)
                ->dehydrated(fn($state) => filled($state))
                // Make hash before saving
                ->dehydrateStateUsing(fn(string $state) => Hash::make($state))
                ->maxLength(255)
            ,
        ];
    }

    private static function makeTableColumns() : array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('email_verified_at')
                ->sortable()
                ->dateTime(),
            Tables\Columns\TextColumn::make('created_at')
                ->sortable()
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->sortable()
                ->dateTime(),
            Tables\Columns\TextColumn::make('deleted_at')
                ->sortable()
                ->dateTime(),
        ];
    }
}
