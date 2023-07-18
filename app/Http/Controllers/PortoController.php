<?php

namespace App\Http\Controllers;

use App\Models\MPorto;
use App\Models\Porto;
use App\Models\Tag;
use App\Models\TagPorto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortoController extends Controller
{
    public function createPorto(Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'short_desc' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|image',
                'link' => 'required|string',
                'tags_value' => 'required|string',
            ]);
            
            $user = auth()->user();
            DB::beginTransaction();
            $locale = $request->locale_code ?? 'id';
            $data = [
                'user_id' => $user->id,
                $locale => [
                    'title' => $request->title,
                    'short_desc' => $request->short_desc,
                    'description' => $request->description,
                    'photo' => $request->photo,
                    'link' => $request->link,
                    'user_id' => $user->id,
                ]
            ];
            $Mporto = MPorto::create($data);

            if($request->tags_value){
                $tags = explode(',', $request->tags_value);
                foreach ($tags as $key => $value) {
                    $tag = Tag::where('name', $value)->first();
                    if($tag){
                        $tag->jumlah_porto += 1;
                        $tag->save();
                    }else{
                        $tag = Tag::create([
                            'name' => $value,
                            'jumlah_porto' => 1,
                        ]);
                    }
                    TagPorto::create([
                        'porto_id' => $Mporto->translate($locale)->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
            DB::commit();
            $porto = Porto::find($Mporto->translate($locale)->id);
            if($request->file('photo')){
                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->id.'.'.$extension);   
                DB::beginTransaction();
                $porto->update(['photo'=> $path]);
                DB::commit();
            }
            
            return redirect('/')->with('info', 'Success Add Porto');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function updatePorto($portoId, Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'short_desc' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|image',
                'link' => 'required|string',
                'tags_value' => 'required|string',
            ]);
            
            $user = auth()->user();
            $locale = $request->locale_code ?? 'id';
            DB::beginTransaction();
            $mporto = MPorto::find($portoId);
            
            if(!$mporto){
                return back()->with('error', 'Porto Tidak Ditemukan');
            }
            
            
            $data_update = [
                'title' => $request->title ?? null,
                'short_desc' => $request->short_desc ?? null,
                'description' => $request->description ?? null,
                'link' => $request->link ?? null,
            ];
            // remove null value
            $data_update = array_filter($data_update);
            $data_update = [
                $locale => $data_update,
            ];
            // return $this->sendApiResponse($data_update);
            // foreach ($data_update as $key => $value) {
            //     $porto->translate($locale)->$key = $value;
            // }
            // return $this->sendApiResponse($porto);
            $mporto->update($data_update);      

            if($request->tags_value){
                $tags = explode(',', $request->tags_value);
                
                if($mporto->hasTranslation()){
                    $tagsPortoCurrent = TagPorto::where('porto_id', $mporto->translate($locale)->id)->delete();
                }
                foreach ($tags as $key => $value) {
                    $tag = Tag::where('name', $value)->first();
                    if($tag){
                        $tag->jumlah_porto += 1;
                        $tag->save();
                    }else{
                        $tag = Tag::create([
                            'name' => $value,
                            'jumlah_porto' => 1,
                        ]);
                    }
                    TagPorto::create([
                        'porto_id' => $mporto->translate($locale)->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
                  
            DB::commit();
            if($request->file('photo')){
                $porto = Porto::find($mporto->translate($locale)->id);
                $previousPath = $porto->photo;

                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('/porto','Porto-'.$porto->id.'.'.$extension);   
                DB::beginTransaction();
                $porto->update(['photo'=> $path]);
                DB::commit();
            }
            
            return redirect('/')->with('info', 'Success Add Porto');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', $th->getMessage());
        }
    }

    public function deletePorto($portoId){
        try {
            DB::beginTransaction();
            $porto = MPorto::find($portoId);
            foreach ($porto->translations as $key => $value) {
                if($value->photo){
                    Storage::delete($value->photo);
                }
            }
            $porto->delete();
            DB::commit();
            return redirect('/')->with('info', 'Success Delete Porto');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

}
