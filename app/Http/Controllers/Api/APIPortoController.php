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

            DB::beginTransaction();
            $data = [
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'description' => $request->description,
                'photo' => $request->photo,
                'link' => $request->link,
                'user_id' => 1,
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

    public function updatePorto($id, Request $request){

    }
}
