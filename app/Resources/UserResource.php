<?php

namespace App\Resources;

use App\Models\User;
use App\Resources\UserResource\Pages;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->alpha()
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->alpha()
                    ->maxLength(100)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->minLength(9)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('phone_number_alt')
                    ->tel()
                    ->minLength(9),
                Fieldset::make('Address')
                    ->schema([
                        Forms\Components\TextInput::make('address.city')
                            ->alpha(),
                        Forms\Components\TextInput::make('address.street'),
                        Forms\Components\TextInput::make('address.house_number')
                            ->integer()
                            ->minValue(1),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
