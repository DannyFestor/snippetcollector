<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SnippetResource\Pages;
use App\Filament\Resources\SnippetResource\RelationManagers;
use App\Models\Snippet;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class SnippetResource extends Resource
{
    protected static ?string $model = Snippet::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->required(),

                        Forms\Components\DateTimePicker::make('published_at'),
                    ])->columns(),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\MarkdownEditor::make('description')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                ,
                Tables\Columns\TextColumn::make('published_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'email')
                    ->searchable()
                ,
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Is Published')
                    ->placeholder('All Snippets')
                    ->trueLabel('Only Published')
                    ->falseLabel('Only Unpublished')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('snippets.published_at'),
                        false: fn(Builder $query) => $query
                            ->whereNull('snippets.published_at')
                            ->orWhere('snippets.published_at', '<=', now())
                        ,
                    )
                ,
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations() : array
    {
        return [
            RelationManagers\FilesRelationManager::class,
            RelationManagers\ExamplesRelationManager::class,
            RelationManagers\TagsRelationManager::class,
            RelationManagers\UserRelationManager::class,
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListSnippets::route('/'),
            'create' => Pages\CreateSnippet::route('/create'),
            'edit' => Pages\EditSnippet::route('/{record}/edit'),
        ];
    }
}
