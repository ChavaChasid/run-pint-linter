<?php

namespace App\Resources\ProjectResource\Pages;

use App\Resources\ProjectResource;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
