<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Porto;
use App\Models\Tag;
use App\Models\TagPorto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class APIPortoController extends Controller
{
    public function listPorto(){
        try {
            $data = Porto::get();
            return $this->sendApiResponse($data, 'success Get');
        } catch (\Throwable $th) {
            return $this->sendApiError($th->getMessage(), 400);
        }
    }

    public function createPorto(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'required|string',
                'short_desc' => 'required|string',
                'description' => 'required|string',
                'photo' => 'nullable|file',
                'link' => 'nullable|string',
                'tags_value' => 'required|string'
            ]);
            if($validator->fails()){
                return $this->sendApiError($validator->errors()->first(), 400);
            }

            $user = auth()->user();
            DB::beginTransaction();
            $data = [
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'description' => $request->description,
                'photo' => $request->photo,
                'link' => $request->link,
                'user_id' => $user->id,
            ];
            $porto = Porto::create($data);

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

            if($request->file('photo')){
                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->id.'.'.$extension); 
                DB::beginTransaction();
                $porto->update(['photo'=> $path]);
                DB::commit();
                
            }
            
            return $this->sendApiResponse($porto, 'success Input Data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendApiError($th->getMessage(), 400);
        }
    }

    public function updatePorto($portoId, Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'nullable|string',
                'short_desc' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|image',
                'link' => 'nullable|string',
                'tags_value' => 'nullable|string',
            ]);

            if($validator->fails()){
                return $this->sendApiError($validator->errors()->first(), 400);
            }
            
            // $user = auth()->user();
            // dd($user);
            DB::beginTransaction();
            $porto = Porto::find($portoId);
            
            if(!$porto){
                return $this->sendApiError('Porto Tidak Ditemukan', 400);
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
            $data_update = [
                'title' => $request->title ?? null,
                'short_desc' => $request->short_desc ?? null,
                'description' => $request->description ?? null,
                // 'user_id' => $user->id ?? null,
                'link' => $request->link ?? null,
            ];
            // remove null value
            $data_update = array_filter($data_update);

            $porto->update($data_update);      
                  
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
            
            return $this->sendApiResponse($porto, 'success Update Data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendApiError($th->getMessage(), 400);
        }
    }

    public function deletePorto($portoId, Request $request){
        try {
            DB::beginTransaction();
            $porto = Porto::where('id', $portoId)->delete();
            DB::commit();
            return $this->sendApiResponse(null, 'success Delete Data');
        } catch (\Throwable $th) {
            return $this->sendApiError($th->getMessage(), 400);
        }
    }
}
