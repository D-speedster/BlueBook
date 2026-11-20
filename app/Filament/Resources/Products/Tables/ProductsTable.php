<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('تصویر')
                    ->circular(),
                TextColumn::make('category.name')
                    ->label('دسته‌بندی')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('نامک')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable(),
                TextColumn::make('product_type')
                    ->label('نوع')
                    ->badge()
                    ->formatStateUsing(fn ($state) => config('mahris.product_types')[$state] ?? $state),
                TextColumn::make('price')
                    ->label('قیمت')
                    ->money('IRR', divideBy: 1, locale: 'fa')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('موجودی')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),
                IconColumn::make('is_active')
                    ->label('وضعیت')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('دسته‌بندی')
                    ->relationship('category', 'name'),
                SelectFilter::make('product_type')
                    ->label('نوع محصول')
                    ->options(config('mahris.product_types')),
                TernaryFilter::make('is_active')
                    ->label('فعال'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
