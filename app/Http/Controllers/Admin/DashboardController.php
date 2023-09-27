<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MPorto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        try {
            // DB::table('survey_kepuasan')->
            // select(DB::raw('YEAR(created_at) as year'))
            // ->groupby('year')
            // ->get();
            $data = MPorto::with('translations.tags')
                ->get()->groupBy('created_at')->transform(function($value){
                    return count($value);
                });
            
            // $locale = app()->getLocale();
            
            // $data->transform(function($value) use($locale){
            //     $temp = $value->translateOrDefault($locale);
                
            //     if(!$temp){
                    
            //         $temp = $value->translations[0];
            //     }
            //     $temp->img_url = ($temp->photo) ? Storage::url($temp->photo) : null;
            //     $temp->is_translated = ($temp->locale == $locale) ? true : false;
            //     return $temp;
            // });

            return response()->view('pages.admin.dashboard', ["data" => $data]);
        } catch (\Throwable $th) {
            return response()->view('pages.admin.dashboard');
        }
    }
}
