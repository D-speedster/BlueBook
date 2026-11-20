<?php

namespace App\Filament\Resources\Products\RelationManagers;

use App\Models\Publisher;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $title = 'نسخه‌های کتاب';

    protected static ?string $modelLabel = 'نسخه';

    protected static ?string $pluralModelLabel = 'نسخه‌ها';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('مشخصات نسخه')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام نسخه')
                            ->placeholder('مثلاً: رقعی، جیبی، وزیری')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('publisher_id')
                            ->label('ناشر')
                            ->relationship('publisher', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('نام ناشر')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->label('توضیحات')
                                    ->maxLength(1000),
                            ]),

                        Forms\Components\TextInput::make('translator')
                            ->label('مترجم')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('isbn')
                            ->label('شابک')
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('مشخصات فیزیکی')
                    ->schema([
                        Forms\Components\TextInput::make('size')
                            ->label('قطع')
                            ->placeholder('مثلاً: رقعی، وزیری، رحلی')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('cover_type')
                            ->label('نوع جلد')
                            ->placeholder('مثلاً: شومیز، گالینگور')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('pages')
                            ->label('تعداد صفحات')
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('edition')
                            ->label('نوبت چاپ')
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\TextInput::make('publish_year')
                            ->label('سال انتشار')
                            ->numeric()
                            ->minValue(1300)
                            ->maxValue(1500),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('قیمت و موجودی')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('قیمت (تومان)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->suffix('تومان')
                            ->default(0),

                        Forms\Components\TextInput::make('stock')
                            ->label('موجودی')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->helperText('تعداد موجود در انبار'),

                        Forms\Components\Toggle::make('is_published')
                            ->label('منتشر شده')
                            ->default(true)
                            ->helperText('نسخه‌های منتشرنشده در سایت نمایش داده نمی‌شوند')
                            ->columnSpan(2),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام نسخه')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('publisher.name')
                    ->label('ناشر')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('translator')
                    ->label('مترجم')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('size')
                    ->label('قطع')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' تومان')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('موجودی')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state < 5 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('منتشر شده')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y/m/d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('وضعیت انتشار')
                    ->placeholder('همه')
                    ->trueLabel('منتشر شده')
                    ->falseLabel('منتشر نشده'),

                Tables\Filters\Filter::make('out_of_stock')
                    ->label('ناموجود')
                    ->query(fn ($query) => $query->where('stock', 0)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('افزودن نسخه جدید'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
