<?php

namespace App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Pages;

use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\PurchaseOrderItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseOrderItem extends EditRecord
{
    protected static string $resource = PurchaseOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
