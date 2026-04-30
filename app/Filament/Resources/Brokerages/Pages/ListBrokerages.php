<?php

namespace App\Filament\Resources\Brokerages\Pages;

use App\Filament\Resources\Brokerages\BrokerageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBrokerages extends ListRecords
{
    protected static string $resource = BrokerageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
