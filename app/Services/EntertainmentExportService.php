<?php

namespace App\Services;

use App\Models\Entertainment;
use Illuminate\Support\Collection;

class EntertainmentExportService
{
    public function exportToText(?Collection $entertainments = null): string
    {
        $entertainments = $entertainments ?? Entertainment::with('tags')->get();

        $content = '';
        foreach ($entertainments as $entertainment) {
            $content .= "ID: {$entertainment->id}" . PHP_EOL;
            $content .= "Title: {$entertainment->title}" . PHP_EOL;
            $content .= "URL: {$entertainment->url}" . PHP_EOL;
            $content .= "Status: {$entertainment->status->label()}" . PHP_EOL;
            $content .= "Tags: " . $entertainment->tags->pluck('name')->implode(', ') . PHP_EOL;
            $content .= "Created: {$entertainment->created_at}" . PHP_EOL;
            $content .= str_repeat('-', 50) . PHP_EOL . PHP_EOL;
        }

        return $content;
    }

    public function generateFilename(string $extension = ''): string
    {
        $filename = 'entertainments_' . now()->format('Y-m-d_His');
        return $extension ? "{$filename}.{$extension}" : $filename;
    }
}
