<?php

namespace App\Resources\ProjectResource\Pages;

use App\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {

        return [
            'all' => Tab::make(),
            'active' => Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('is_active', true)),
            'inactive' => Tab::make()
                ->modifyQueryUsing(fn ($query) => $query->where('is_active', false)),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'active';
    }
}
