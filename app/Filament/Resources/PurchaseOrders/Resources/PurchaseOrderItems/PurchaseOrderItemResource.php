<?php

namespace App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems;

use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use App\Models\PurchaseOrderItem;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\ParentResourceRegistration;
use App\Filament\Resources\PurchaseOrders\PurchaseOrderResource;
use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Pages\EditPurchaseOrderItem;
use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Pages\CreatePurchaseOrderItem;
use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Schemas\PurchaseOrderItemForm;
use App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Tables\PurchaseOrderItemsTable;

class PurchaseOrderItemResource extends Resource
{
    protected static ?string $model = PurchaseOrderItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // protected static ?string $parentResource = PurchaseOrderResource::class;

    public static function getParentResourceRegistration(): ?ParentResourceRegistration
    {
        return PurchaseOrderResource::asParent()
            ->relationship('items');
    }

    public static function form(Schema $schema): Schema
    {
        return PurchaseOrderItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PurchaseOrderItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreatePurchaseOrderItem::route('/create'),
            'edit' => EditPurchaseOrderItem::route('/{record}/edit'),
        ];
    }
}
