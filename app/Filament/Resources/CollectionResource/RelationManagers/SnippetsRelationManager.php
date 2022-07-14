<?php

namespace App\Filament\Resources\CollectionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SnippetsRelationManager extends RelationManager
{
    protected static string $relationship = 'snippets';

    protected static ?string $recordTitleAttribute = 'title';

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_column')
                    ->sortable()
                ,
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn(Model $record) => route('filament.resources.snippets.edit', $record))
                ,
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('up')
                    ->action(fn(Model $record) => $record->moveOrderUp()),
                Tables\Actions\Action::make('down')
                    ->action(fn(Model $record) => $record->moveOrderDown()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('order_column');
    }
}
