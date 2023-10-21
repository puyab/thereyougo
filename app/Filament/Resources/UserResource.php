<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Profile;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
  protected static ?string $model = User::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('id')
          ->label('ID')
          ->readOnly(),
        Forms\Components\TextInput::make('email')
          ->email()
          ->required()
          ->unique()
          ->label('Email'),
        Forms\Components\Select::make('role')
          ->required()
          ->options(['admin' => 'Admin', 'customer' => 'Customer', 'super_admin' => 'Super Admin'])
          ->label('Type')
          ->helperText('This is the role of the user in system')
          ->disabled(fn (User $record) => $record->role !== 'super_admin')
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('id')
          ->sortable()
          ->searchable()
          ->label('ID'),
        Tables\Columns\TextColumn::make('profile.first_name')
          ->searchable()
          ->label('First Name'),
        Tables\Columns\TextColumn::make('profile.last_name')
          ->searchable()
          ->label('Last Name'),
        Tables\Columns\TextColumn::make('role')
          ->sortable()
          ->label('Type'),
        Tables\Columns\TextColumn::make('email')
          ->searchable()
          ->label('Email'),
        Tables\Columns\TextColumn::make('profile.role')
          ->searchable()
          ->label('Role'),
        Tables\Columns\TextColumn::make('profile.telephone')
          ->searchable()
          ->label('Telephone'),
        Tables\Columns\TextColumn::make('profile.location')
          ->searchable()
          ->limit(10)
          ->label('Address'),
        Tables\Columns\TextColumn::make('profile.bedrooms')
          ->sortable()
          ->searchable()
          ->label('Bedrooms'),
        Tables\Columns\TextColumn::make('profile.sleep_rooms')
          ->searchable()
          ->sortable()
          ->label('People'),
        Tables\Columns\IconColumn::make('profile.high_speed_wifi')
          ->sortable()
          ->true(icon: 'heroicon-o-check')
          ->false(icon: 'heroicon-o-x-mark')
          ->label('High Speed Wifi'),
        Tables\Columns\TextColumn::make('profile.status')
          ->sortable()
          ->formatStateUsing(fn(User $record) => ucfirst($record->profile->status))
          ->label('Status'),
        Tables\Columns\TextColumn::make('profile.referral_code')
          ->sortable()
          ->searchable()
          ->label('Referral Code')
          ->limit(14),
        Tables\Columns\TextColumn::make('profile')
          ->formatStateUsing(fn(User $record) => Profile::query()->where('referred_from', $record->profile->referral_code)->count())
          ->label('Referred'),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('status')
          ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
          ->query(fn(Builder $query, array $data) => $data['value'] ? $query->whereHas('profile', fn(Builder $query) => $query->where('status', $data['value'])) : null)
          ->label('Status'),
        Tables\Filters\SelectFilter::make('role')
          ->options(['admin' => 'Admin', 'customer' => 'Customer'])
          ->label('Type'),
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
      RelationManagers\ProfilesRelationManager::class
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
