<?php
namespace App\Filament\Resources\SisterConcerns\Pages;
use App\Filament\Resources\SisterConcerns\SisterConcernResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListSisterConcerns extends ListRecords {
    protected static string $resource = SisterConcernResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}