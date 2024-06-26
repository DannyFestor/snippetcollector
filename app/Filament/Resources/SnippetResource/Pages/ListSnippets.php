<?php

namespace App\Filament\Resources\SnippetResource\Pages;

use App\Filament\Resources\SnippetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSnippets extends ListRecords
{
    protected static string $resource = SnippetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
