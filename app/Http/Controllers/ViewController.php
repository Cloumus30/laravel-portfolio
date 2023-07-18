<?php

namespace App\Http\Controllers;

use App\Models\MPorto;
use App\Models\Porto;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    protected $locale;
    public function __construct()
    {
        $this->locale = app()->getLocale();
    }
    public function home(){
        $porto = MPorto::with('translations.tags')->orderBy('updated_at', 'desc')->get();
        $locale = app()->getLocale();
        $porto->transform(function($value) use($locale){
            $temp = $value->translateOrDefault($locale);
            
            if(!$temp){
                
                $temp = $value->translations[0];
            }
            $temp->img_url = ($temp->photo) ? Storage::url($temp->photo) : null;
            $temp->is_translated = ($temp->locale == $locale) ? true : false;
            return $temp;
        });
        
        return view('pages.landing-v2.home',['portos' => $porto]);
    }

    public function login(){
        $user = auth()->user();
        if($user){
            return redirect('/')->with('info', 'Anda Sudah login');   
        }
        return view('pages.loginPage');
    }

    public function formPorto(){
        $tags = Tag::get();
        $tags->transform(function($value){
            return $value->name;
        });
        return view('pages.formPortoPage', ['tags' => $tags]);
    }

    public function viewPorto($id){
        $mporto = MPorto::with('translations.tags')->find($id);
        if(!$mporto){
            return back()->with('error', 'Porto Tidak Ditemukan');
        }
        $porto = $mporto->translate($this->locale);
        if($porto){
            $porto->tags->transform(function($value){
                return $value->name;
            });
            $porto =collect($porto->toArray());
            $img_url = ($porto['photo']) ? Storage::url($porto['photo']) : null;
            $porto['img_url'] = $img_url;
        }
        $tags = Tag::get();
        $tags->transform(function($value){
            return $value->name;
        });
        
        return view('pages.formPortoPage', ['porto' => $porto, 
            'tags' => $tags, 
            'is_edit' => true, 
            'm_porto_id' => $mporto->id,
        ]);
    }

    public function viewDetailPorto($id){
        $porto = Porto::find($id);
        
        if(!$porto){
            return back()->with('error', 'Porto Tidak Ditemukan');
        }
        $porto =collect($porto->toArray());
        $img_url = ($porto['photo']) ? Storage::url($porto['photo']) : null;
        $porto['img_url'] = $img_url;
        return view('pages.landing-v2.detailPorto',['porto' => $porto]);
    }
}
