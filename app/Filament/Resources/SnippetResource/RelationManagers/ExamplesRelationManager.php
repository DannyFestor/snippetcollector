<?php

namespace App\Filament\Resources\SnippetResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamplesRelationManager extends RelationManager
{
    protected static string $relationship = 'examples';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Card::make([
                    Forms\Components\MarkdownEditor::make('code')
                        ->required()
                        ->maxLength(65535)
                        ->hint('Code that is shown on the page'),
                    Forms\Components\Textarea::make('implementation')
                        ->required()
                        ->maxLength(65535)
                        ->hint('Component that is run/shown on the page'),
                ]),
                Forms\Components\Card::make([
                    Forms\Components\Textarea::make('styles')
                        ->maxLength(65535)
                        ->hint('Additional Styles if needed'),
                    Forms\Components\Textarea::make('scripts')
                        ->maxLength(65535)
                        ->hint('Additional scripts if needed'),
                ]),
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('order_column')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('up')
                    ->action(fn (Model $record) => $record->moveOrderUp()),
                Tables\Actions\Action::make('down')
                    ->action(fn (Model $record) => $record->moveOrderDown()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('order_column');
    }
}
