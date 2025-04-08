<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Models\Tour;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // Основная информация
                Section::make('Основная информация')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Название тура')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('title_description')
                                    ->label('Подзаголовок')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('duration')
                                    ->label('Длительность')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('rating')
                                    ->label('Рейтинг')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        TagsInput::make('tags')
                            ->label('Теги')
                            ->required(),

                        Toggle::make('hidden')
                            ->label('Скрыт?')
                            ->required(),
                    ])
                    ->collapsible(),

                // Цены
                Section::make('Цены')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Цена')
                                    ->prefix('$')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('price_discount')
                                    ->label('Процент скидки')
                                    ->default(0)
                                    ->numeric()
                                    ->required(),
                            ]),
                    ])
                    ->collapsible(),

                // Описание
                Section::make('Описание')
                    ->schema([
                        RichEditor::make('description.content')
                            ->label('Основной текст')
                            ->required()
                            ->columnSpanFull(),

                        Repeater::make('description.list')
                            ->label('Список достоинств / пунктов')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('key')
                                            ->label('Заголовок пункта')
                                            ->required(),

                                        Textarea::make('value')
                                            ->label('Описание пункта')
                                            ->required(),
                                    ]),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null)
                            ->addActionLabel('Добавить пункт')
                            ->reorderable()
                            ->required(),
                    ])
                    ->collapsible(),

                // Программа тура
                Section::make('Программа')
                    ->schema([
                        RichEditor::make('program.content')
                            ->label('Основной текст программы')
                            ->required()
                            ->columnSpanFull(),

                        Repeater::make('program.list')
                            ->label('Этапы программы')
                            ->schema([
                                TextInput::make('step')
                                    ->label('Порядковый номер')
                                    ->numeric()
                                    ->required(),
                                FileUpload::make('image')
                                    ->label('Изображение')
                                    ->image()
                                    ->required()

                                    ->directory('program-images')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Заголовок шага')
                                    ->required(),
                                RichEditor::make('description')
                                    ->label('Описание шага')
                                    ->required(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel('Добавить шаг')
                            ->reorderable()
                            ->required(),
                    ])
                    ->collapsible(),

                // Медиа
                Section::make('Изображения')
                    ->schema([
                        FileUpload::make('header_image')
                            ->label('Главное изображение')
                            ->directory('tours')
                            ->disk('public')
                            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, BaseFileUpload $component) {
                                $pathOriginal = $file->store('tours', 'public');


                                $originalAbsolutePath = Storage::disk('public')->path($pathOriginal);

                                $filenameWithoutExt = pathinfo($originalAbsolutePath, PATHINFO_FILENAME);
                                $extension = pathinfo($originalAbsolutePath, PATHINFO_EXTENSION);

                                $sizes = [
                                    [800, 533],
                                    [1400, 470],
                                ];

                                foreach ($sizes as [$width, $height]) {
                                    $newFileName = $filenameWithoutExt . "_{$width}x{$height}." . $extension;

                                    $resized = Image::read($originalAbsolutePath)
                                        ->resize($width, $height);

                                    $resized->save(Storage::disk('public')->path("tours/{$newFileName}"));
                                }

                                $component->state($pathOriginal);
                                return $pathOriginal;
                            }),

                        FileUpload::make('images')
                            ->label('Галерея')
                            ->multiple()
                            ->image()
                            ->imagePreviewHeight('50')
                            ->directory('tours')
                            ->storeFiles()
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('hidden')
                    ->label('Скрыт?')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title_description')
                    ->label('Подзаголовок')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('header_image')
                    ->label('Изображение'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('euro')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_discount')
                    ->label('Скидка')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Длительность')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Рейтинг')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Добавляйте фильтры при необходимости
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
