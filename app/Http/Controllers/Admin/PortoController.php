<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PortoExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\PortoImport;
use App\Models\MPorto;
use App\Models\Porto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PortoController extends Controller
{
    public function index(){
        try {
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
            
            return response()->view('pages.admin.porto', ['data' => $data]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->view('pages.admin.porto');
        }
    }

    public function import(Request $request){
        // dd($request->file('file'));
        try {
            $data = Excel::import(new PortoImport, $request->file('file'));
            return redirect('/admin/porto');
        } catch (\Throwable $th) {
            dd($th);
        }   
    }

    public function export(Request $request){
        try {
            return Excel::download(new PortoExport, 'porto.xlsx');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function exportPdf(Request $request){
        try {
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

            $pdf  = Pdf::loadView('export.porto', ['data' => $data]);
            return $pdf->download('porto.pdf');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
