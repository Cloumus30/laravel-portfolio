<?php

namespace App\Exports;

use App\Models\MPorto;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PortoExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = MPorto::with('translations.tags')->orderBy('updated_at', 'desc')->cursorPaginate();
        $locale = app()->getLocale();
        
        $data->transform(function($value) use($locale){
            $temp = $value->translateOrDefault($locale);
            
            if(!$temp){
                
                $temp = $value->translations[0];
            }
            $temp->img_url = ($temp->photo) ? Storage::url($temp->photo) : null;
            $temp->is_translated = ($temp->locale == $locale) ? true : false;
            return $temp;
        });
        
        return $data;
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->title,
            $row->short_desc,
            $row->link,
            $row->description,
            $row->locale,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'judul',
            'deskripsi_singkat',
            'link',
            'deskripsi',
            'bahasa',
        ];
    }
}

