<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilesRelationManager extends RelationManager
{
  protected static string $relationship = 'profile';

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('id')
          ->required()
          ->disabled(),
        Forms\Components\TextInput::make('first_name')
          ->required()
          ->label('First Name'),
        Forms\Components\TextInput::make('last_name')
          ->required()
          ->label('Last Name'),
        Forms\Components\TextInput::make('role')
          ->nullable()
          ->label('Role'),
        Forms\Components\TextInput::make('company')
          ->nullable()
          ->label('Company'),
        Forms\Components\TextInput::make('telephone')
          ->nullable()
          ->label('Telephone'),
        Forms\Components\TextInput::make('location')
          ->nullable()
          ->disabled()
          ->label('Location'),
        Forms\Components\Select::make('accommodation_type')
          ->options(['house' => "House", 'apartment' => 'Apartment', 'room' => 'Room'])
          ->nullable()
          ->label('Accommodation Type'),
        Forms\Components\Select::make('bedrooms')
          ->nullable()
          ->options([1 => '1', 2 => '2', 3 => '3', 4 => '', 5 => '5+'])
          ->label('Bedrooms'),
        Forms\Components\Select::make('sleep_rooms')
          ->nullable()
          ->options([1 => '1', 2 => '2', 3 => '3', 4 => '', 5 => '5+'])
          ->label('People'),
        Forms\Components\TextInput::make('linkedin')
          ->activeUrl()
          ->label('Linkedin')
          ->required()
          ->unique(),
        Forms\Components\Select::make('high_speed_wifi')
          ->nullable()
          ->options([true => 'Yes', false => 'No'])
          ->label('High Speed Wifi'),
        Forms\Components\Select::make('status')
          ->required()
          ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
          ->label('Status'),
        Forms\Components\TextInput::make('referral_code')
          ->disabled()
          ->required()
          ->label('Referral Code'),
      ]);
  }

  public function table(Table $table): Table
  {
    return $table
      ->recordTitleAttribute('id')
      ->columns([
        Tables\Columns\TextColumn::make('id')
          ->label('ID'),
        Tables\Columns\TextColumn::make('first_name')
          ->searchable()
          ->label('First Name'),
        Tables\Columns\TextColumn::make('last_name')
          ->searchable()
          ->label('Last Name'),
        Tables\Columns\TextColumn::make('role')
          ->searchable()
          ->label('Role'),
        Tables\Columns\TextColumn::make('telephone')
          ->searchable()
          ->label('Telephone'),
        Tables\Columns\TextColumn::make('location')
          ->searchable()
          ->limit(10)
          ->label('Address'),
        Tables\Columns\TextColumn::make('bedrooms')
          ->sortable()
          ->searchable()
          ->label('Bedrooms'),
        Tables\Columns\TextColumn::make('sleep_rooms')
          ->searchable()
          ->sortable()
          ->label('People'),
        Tables\Columns\IconColumn::make('high_speed_wifi')
          ->sortable()
          ->true(icon: 'heroicon-o-check')
          ->false(icon: 'heroicon-o-x-mark')
          ->label('High Speed Wifi'),
        Tables\Columns\TextColumn::make('profile.status')
          ->sortable()
          ->formatStateUsing(fn(Profile $record) => ucfirst($record->status))
          ->label('Status'),
        Tables\Columns\TextColumn::make('referral_code')
          ->sortable()
          ->searchable()
          ->label('Referral Code')
          ->limit(14)
      ])
      ->filters([
        //
      ])
      ->headerActions([
        Tables\Actions\CreateAction::make(),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }
}
