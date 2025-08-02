<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ExportCSV
{
    public function export($model)
    {
        $data = $model::all();

        $fileName = 'data.csv';
        $filePath = storage_path("app/{$fileName}");

        $csvFile = fopen($filePath, 'w');

        $headers = ['name', 'email', 'created_at'];
        fputcsv($csvFile, $headers);

        foreach ($data as $item) {
            fputcsv($csvFile, [
                $item->name,
                $item->email,
                $item->created_at,
            ]);
        }

        fclose($csvFile);

        return Response::download($filePath, $fileName)->deleteFileAfterSend(true);
    }
}

