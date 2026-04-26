<?php

namespace App\Filament\Resources\TeamGalleries\Pages;

use App\Filament\Resources\TeamGalleries\TeamGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeamGallery extends EditRecord
{
    protected static string $resource = TeamGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
