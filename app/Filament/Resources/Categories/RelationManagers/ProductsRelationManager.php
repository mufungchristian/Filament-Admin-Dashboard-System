<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Operation;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\DissociateBulkAction;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextInput::make('name')
                        ->required(),
                    TextInput::make('sku')
                        ->label('SKU')
                        ->required()
                        ->readOnly()
                        ->hiddenOn(Operation::Create),
                    Textarea::make('description')
                        ->columnSpanFull(),
                        // Select::make('category_id')
                        // ->relationship('category', 'name')
                        // ->searchable()
                        // ->preload()
                        // ->required(),
                    Select::make(name: 'supplier_id')
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email address')
                                ->email(),
                            TextInput::make('phone')
                                ->tel(),
                            Textarea::make('address')
                                ->columnSpanFull(),
                            TextInput::make('contact_person'),
                            Toggle::make('is_active')
                                ->required(),
                        ]),
                        TextInput::make('purchase_price')
                        ->required()
                        ->prefix('TZS')
                        ->numeric()
                        ->default(0),
                    TextInput::make('selling_price')
                        ->required()
                        ->prefix('TZS')
                        ->numeric()
                        ->default(0),
                        TextInput::make('current_stock')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('minimum_stock')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('unit')
                        ->required()
                        ->default('pcs'),
                    TextInput::make('barcode'),
                     FileUpload::make('image')
                        ->image(),
                    Toggle::make('is_active')
                        ->required(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sku'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        // ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
            ->recordTitleAttribute('sku')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable(),
                TextColumn::make('supplier.name')
                    ->sortable(),
                TextColumn::make('purchase_price')
                    ->numeric()
                    ->money('TZS')
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->numeric()
                    ->money('TZS')
                    ->sortable(),
                TextColumn::make('current_stock')
                    ->numeric()
                    ->sortable(),
                
                ImageColumn::make('image'),
                IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                ->label('Status')
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
