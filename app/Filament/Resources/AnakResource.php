<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnakResource\Pages;
use App\Filament\Resources\AnakResource\RelationManagers;
use App\Models\Anak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnakResource extends Resource
{
    protected static ?string $model = Anak::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_kelamin')
                    ->required()
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $birthDate = \Carbon\Carbon::parse($state);
                            $months = ceil($birthDate->diffInMonths(now(), false) + ($birthDate->diffInDaysFiltered(function($date) { return true; }, now()) % 30 > 0 ? 1 : 0));
                            $set('umur_bulan', (int) $months);
                        } else {
                            $set('umur_bulan', null);
                        }
                    }),
                Forms\Components\TextInput::make('umur_bulan')
                    ->label('Umur (Bulan)')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),
                Forms\Components\TextInput::make('berat')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tinggi')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lingkar_kepala')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lingkar_lengan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_vit_a')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('pendidikan_ayah')
                    ->required()
                    ->options([
                        '-' => '-',
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                        'D3' => 'D3',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ]),
                Forms\Components\Select::make('pendidikan_ibu')
                    ->required()
                    ->options([
                        '-' => '-',
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                        'D3' => 'D3',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ]),
                Forms\Components\TextInput::make('status_gizi')
                    ->hidden()
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Orang Tua')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Anak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('umur_bulan')
                    ->label('Umur (Bulan)'),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->label('Daerah Kecamatan')
                    ->searchable(),
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
            'index' => Pages\ListAnaks::route('/'),
            'create' => Pages\CreateAnak::route('/create'),
            'view' => Pages\ViewAnak::route('/{record}'),
            'edit' => Pages\EditAnak::route('/{record}/edit'),
        ];
    }
}
