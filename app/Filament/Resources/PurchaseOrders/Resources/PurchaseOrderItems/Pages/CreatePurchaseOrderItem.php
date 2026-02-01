<?php

namespace App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Pages;

use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\PurchaseOrderItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseOrderItem extends CreateRecord
{
    protected static string $resource = PurchaseOrderItemResource::class;
}
