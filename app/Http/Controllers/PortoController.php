<?php

namespace App\Http\Controllers;

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
            $porto = Porto::create([
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'description' => $request->description,
                'user_id' => $user->id,
                'link' => $request->link,
            ]);            
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
                        'porto_id' => $porto->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
            DB::commit();
            $porto = Porto::find($porto->id);
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
            DB::beginTransaction();
            $porto = Porto::find($portoId);
            if(!$porto){
                return back()->with('error', 'Porto Tidak Ditemukan');
            }

            if($request->tags_value){
                $tags = explode(',', $request->tags_value);
                $tagsPortoCurrent = TagPorto::where('porto_id', $porto->id)->delete();
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
                        'porto_id' => $porto->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
            
            $porto->update([
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'description' => $request->description,
                'user_id' => $user->id,
                'link' => $request->link,
            ]);      
                  
            DB::commit();
            if($request->file('photo')){
                $porto = Porto::find($portoId);
                $previousPath = $porto->photo;

                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->id.'.'.$extension);   
                DB::beginTransaction();
                $porto->update(['photo'=> $path]);
                DB::commit();
            }
            
            return redirect('/')->with('info', 'Success Add Porto');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function deletePorto($portoId){
        try {
            DB::beginTransaction();
            $porto = Porto::find($portoId);
            if($porto->photo){
                Storage::delete($porto->photo);
            }
            $porto->delete();
            DB::commit();
            return redirect('/')->with('info', 'Success Delete Porto');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
