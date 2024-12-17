<?php

declare(strict_types=1);

namespace App\Filament\Resources\AdTemplateResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TemplateRelationManager extends RelationManager
{
    protected static string $relationship = 'template';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('canva_url')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->hidden($this->getOwnerRecord()->template()->exists())
                    ->createAnother(false)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
