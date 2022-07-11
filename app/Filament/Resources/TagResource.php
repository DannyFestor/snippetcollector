<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Title')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'tags', column: 'title', ignorable: fn(?Model $record) : ?Model => $record)
                            ->reactive()
                        ,
                        Forms\Components\ViewField::make('preview')
                            ->view('filament.forms.components.color-preview'),
                        Forms\Components\FileUpload::make('logo'),
                    ])
                    ->columns(3)
                ,
                Forms\Components\Section::make('colors')
                    ->schema([
                        Forms\Components\ColorPicker::make('color')
                            ->hex()
                            ->reactive(),
                        Forms\Components\ColorPicker::make('bgcolor')
                            ->hex()
                            ->reactive(),
                        Forms\Components\ColorPicker::make('bordercolor')
                            ->hex()
                            ->reactive(),
                    ])
                    ->columns(3)
                ,
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->formatStateUsing(fn($state, Tag $record) => new HtmlString(
                        <<<HTML
                    <span class="rounded px-2 py-1" style="color: $record->color; background-color: $record->bgcolor; border: 1px solid $record->bordercolor">$state</span>
                    HTML
                    ))
                    ->sortable()
                    ->searchable()
                ,
                Tables\Columns\TextColumn::make('color')
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('bgcolor')
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('bordercolor')
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('snippets_count')
                    ->counts('snippets'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                ,
            ])
            ->filters([
                //
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
            RelationManagers\SnippetsRelationManager::class,
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
