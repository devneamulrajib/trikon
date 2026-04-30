<?php

namespace App\Filament\Resources\Brokerages\Pages;

use App\Filament\Resources\Brokerages\BrokerageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrokerage extends EditRecord
{
    protected static string $resource = BrokerageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
