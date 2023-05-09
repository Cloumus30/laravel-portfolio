<?php

namespace App\Http\Controllers;

use App\Models\Porto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function home(){
        $porto = Porto::orderBy('updated_at', 'desc')->get();
        $porto->transform(function($value){
            $value->img_url = ($value->photo) ? Storage::url($value->photo) : null;
            return $value;
        });
        
        return view('pages.app',['portos' => $porto]);
    }

    public function login(){
        $user = auth()->user();
        if($user){
            return redirect('/')->with('info', 'Anda Sudah login');   
        }
        return view('pages.loginPage');
    }

    public function formPorto(){
        return view('pages.formPortoPage');
    }

    public function viewPorto($id){
        $porto = Porto::find($id);
        if(!$porto){
            return back()->with('error', 'Porto Tidak Ditemukan');
        }
        $porto =collect($porto->toArray());
        $img_url = ($porto['photo']) ? Storage::url($porto['photo']) : null;
        $porto['img_url'] = $img_url;
        return view('pages.formPortoPage', ['porto' => $porto]);
    }

    public function viewDetailPorto($id){
        $porto = Porto::find($id);
        if(!$porto){
            return back()->with('error', 'Porto Tidak Ditemukan');
        }
        $porto =collect($porto->toArray());
        $img_url = ($porto['photo']) ? Storage::url($porto['photo']) : null;
        $porto['img_url'] = $img_url;
        return view('pages.detailPortoPage',['porto' => $porto]);
    }
}
