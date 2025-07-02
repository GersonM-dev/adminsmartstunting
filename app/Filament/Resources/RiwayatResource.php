<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatResource\Pages;
use App\Filament\Resources\RiwayatResource\RelationManagers;
use App\Models\Riwayat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RiwayatResource extends Resource
{
    protected static ?string $model = Riwayat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('anak_id')
                    ->label('Nama Anak')
                    ->relationship('anak', 'nama') // pastikan 'nama' sesuai kolom nama anak
                    ->searchable()
                    ->required(),

                Forms\Components\DateTimePicker::make('timestamp')
                    ->required(),
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('status_stunting')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('status_underweight')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('status_wasting')
                        ->required()
                        ->maxLength(255),
                ])->columns(3)->columnSpanFull(),
                Forms\Components\RichEditor::make('rekomendasi')
                    ->required()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anak.user.name')
                    ->label('Nama Orang Tua'),
                Tables\Columns\TextColumn::make('anak.nama')
                    ->label('Nama Anak')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anak.umur_bulan')
                    ->label('Umur (bulan)'),
                Tables\Columns\TextColumn::make('timestamp')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_stunting')
                    ->label('Status Stunting'),
                Tables\Columns\TextColumn::make('status_underweight')
                    ->label('Status Underweight'),
                Tables\Columns\TextColumn::make('status_wasting')
                    ->label('Status Wasting'),
                Tables\Columns\TextColumn::make('rekomendasi')
                    ->label('Rekomendasi')
                    ->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRiwayats::route('/'),
            'create' => Pages\CreateRiwayat::route('/create'),
            'view' => Pages\ViewRiwayat::route('/{record}'),
            'edit' => Pages\EditRiwayat::route('/{record}/edit'),
        ];
    }
}
