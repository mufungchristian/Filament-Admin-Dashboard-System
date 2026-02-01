<?php

namespace App\Filament\Resources\PurchaseOrders\Resources\PurchaseOrderItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurchaseOrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('purchase_order_id')
                //     ->required()
                //     ->numeric(),
                Section::make('Purchase Order Item Info')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('product_id')
                            ->required()
                            ->relationship('product', 'name')
                            ->preload()
                            ->searchable(),
                        TextInput::make('quantity_ordered')
                            ->required()
                            ->live(onBlur:true)
                            ->afterStateUpdated(function(callable $get, callable $set){
                                $quantity = (float) $get('quantity_ordered') ?? 0;
                                $unitPrice = (float) $get('unit_price') ?? 0;
                                $set('total_price', $quantity * $unitPrice);
                            })
                            ->numeric(),
                        TextInput::make('quantity_received')
                            ->required()
                            ->readOnly()
                            ->numeric()
                            ->default(0),
                        TextInput::make('unit_price')
                            ->required()
                            ->live(onBlur:true)
                            ->prefix('TZS')
                            ->afterStateUpdated(function(callable $get, callable $set){
                                $quantity = (float) $get('quantity_ordered') ?? 0;
                                $unitPrice = (float) $get('unit_price') ?? 0;
                                $set('total_price', $quantity * $unitPrice);
                            })
                            ->numeric(),
                        TextInput::make('total_price')
                            ->required()
                            ->readOnly()
                            ->prefix('TZS')
                            ->numeric(),
                    ])

            ]);
    }
}
