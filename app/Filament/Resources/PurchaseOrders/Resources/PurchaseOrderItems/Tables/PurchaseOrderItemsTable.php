<?php

namespace App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Tables;

use App\Models\PurchaseOrderItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PurchaseOrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->sortable(),
                TextColumn::make('quantity_ordered')
                    ->numeric()
                    ->badge()
                    ->sortable(),
                TextColumn::make('quantity_received')
                    ->numeric()
                    ->badge()
                    ->sortable(),
                TextColumn::make('unit_price')
                    ->numeric()
                    ->money('TZS')
                    ->sortable(),
                TextColumn::make('total_price')
                    ->numeric()
                    ->money('TZS')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
