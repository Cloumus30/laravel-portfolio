<?php

namespace App\Imports;

use App\Models\MPorto;
use App\Models\Porto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PortoImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        $userId = auth()->user()->id ?? 1;
        foreach ($collection as $row) {
            $locale = $row['bahasa'] ?? 'id';
            $data = [
                'user_id' => $userId,
                $locale => [
                    'title' => $row['judul'],
                    'short_desc' => $row['deskripsi_singkat'],
                    'description' => $row['deskripsi'],
                    'link' => $row['link'],
                    'user_id' => $userId,
                    'locale' => $row['bahasa'] ?? 'id',
                ]
            ];
            $Mporto = MPorto::create($data); 
        }
    }
}
