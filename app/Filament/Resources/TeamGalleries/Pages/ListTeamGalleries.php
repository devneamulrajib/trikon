<?php

namespace App\Filament\Resources\TeamGalleries\Pages;

use App\Filament\Resources\TeamGalleries\TeamGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeamGalleries extends ListRecords
{
    protected static string $resource = TeamGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
