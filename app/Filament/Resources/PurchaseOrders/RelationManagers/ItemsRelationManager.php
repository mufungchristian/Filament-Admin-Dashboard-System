<?php

namespace App\Filament\Resources\PurchaseOrders\RelationManagers;

use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\PurchaseOrderItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $relatedResource = PurchaseOrderItemResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
