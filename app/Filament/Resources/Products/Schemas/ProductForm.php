<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('اطلاعات اصلی کتاب')
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان کتاب')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', \App\Helpers\SlugHelper::make($state))),
                        
                        TextInput::make('slug')
                            ->label('نامک (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('به صورت خودکار از عنوان ساخته می‌شود'),
                        
                        TagsInput::make('authors')
                            ->label('نویسنده(ها)')
                            ->placeholder('نام نویسنده را وارد کرده و Enter بزنید')
                            ->helperText('می‌توانید چند نویسنده اضافه کنید'),
                        
                        Select::make('category_id')
                            ->label('دسته‌بندی')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('نام دسته‌بندی')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('توضیحات')
                                    ->rows(2),
                            ]),
                    ])
                    ->columns(2),
                
                Section::make('توضیحات و خلاصه')
                    ->schema([
                        Textarea::make('summary')
                            ->label('خلاصه کتاب')
                            ->rows(3)
                            ->helperText('خلاصه کوتاهی از محتوای کتاب'),
                        
                        Textarea::make('description')
                            ->label('توضیحات تکمیلی')
                            ->rows(5)
                            ->helperText('توضیحات کامل و معرفی دقیق‌تر کتاب'),
                    ]),
                
                Section::make('تصاویر')
                    ->schema([
                        FileUpload::make('cover_image')
                            ->label('تصویر جلد کتاب')
                            ->image()
                            ->directory('books/covers')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->helperText('تصویر با کیفیت جلد کتاب'),
                        
                        FileUpload::make('image')
                            ->label('تصویر اضافی')
                            ->image()
                            ->directory('books')
                            ->imageEditor()
                            ->maxSize(2048),
                    ])
                    ->columns(2),
                
                Section::make('وضعیت')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('فعال')
                            ->default(true)
                            ->helperText('کتاب‌های غیرفعال در سایت نمایش داده نمی‌شوند'),
                    ])
                    ->description('برای مدیریت قیمت و موجودی هر نسخه، پس از ذخیره کتاب به تب "نسخه‌ها" مراجعه کنید'),
            ]);
    }
}
