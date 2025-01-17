<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    // Untuk membuat form input pada data office space, digunakan saat create dan edit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->required(),

                Forms\Components\Textarea::make('about')
                    ->required()
                    ->rows(10)
                    ->cols(20),

                /* 
                    Dapat dibaca menjadi
                    1 office akan memiliki lebih dari 1 photo
                    Data photo akan disimpan ke dalam OfficeSpacePhoto
                    Repeater agar semua photo dapat digabungkan
                */
                Forms\Components\Repeater::make('photos')
                    ->relationship('photos') // Menggunakan relasi photos dari model OfficeSpace
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->required(),
                    ]),

                // Mirip seperti photos diatas
                Forms\Components\Repeater::make('benefits')
                    ->relationship('benefits')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ]),

                // Untuk menampilkan semua data city yang sudah dibuat
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix("IDR"),

                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->prefix("Days"),

                Forms\Components\Select::make('is_open')
                    ->options([
                        true => 'Open',
                        false => 'Not Open',
                    ])
                    ->required(),

                Forms\Components\Select::make('is_full_booked')
                    ->options([
                        true => 'Not Available',
                        false => 'Available',
                    ])
                    ->required(),
            ]);
    }

    // Untuk tampilan data (View)
    public static function table(Table $table): Table
    {
        return $table
            // Isi data pada table city dan sesuai yang sudah dibuat pada form sebelumnya
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('thumbnail'),

                // Menggunakan dot notation untuk mengambil field name dari table city
                Tables\Columns\TextColumn::make('city.name'),

                Tables\Columns\IconColumn::make('is_full_booked')
                    ->boolean()
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->label('Available'),
            ])
            // Untuk filtering data
            ->filters([
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name'),
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}
