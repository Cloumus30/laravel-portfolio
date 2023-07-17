<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MPorto;
use App\Models\Porto;
use App\Models\Tag;
use App\Models\TagPorto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @authenticated
 */
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

    /**
     * List Porto Translation
     * 
     * @queryParam locale nullable string Locale Code. Example: id
     */
    public function listPortoTranslate(Request $request){
        try {
            $locale = $request->query('locale') ?? 'id';
            MPorto::disableAutoloadTranslations();
            
            $portos = MPorto::with('translations.tags')->paginate()
                ->through(function($value) use($locale){
                    $val = $value->translateOrDefault($locale);
                    $val->is_translated = ($val->locale == $locale) ? true : false;
                    return $val;
                });
            return $this->sendApiResponse($portos, 'success Get');
        } catch (\Throwable $th) {
            return $this->sendApiError($th->getMessage(), 400);
        }
    }

    /**
     * Create Porto Translation
     * 
     * @bodyParam title string required Title Of the Porto. Example: Judul porto
     * @bodyParam short_desc string required Short Description. Example: Short Descript
     * @bodyParam description string required Full Description. Example: Long Descriptions
     * @bodyParam photo file nullable Image of the Porto.
     * @bodyParam link string nullable Links To Portofolio. Example: https://cloudias.my.id
     * @bodyParam tags_value string required Tags Tech For Portofolio separate by comma. Example: laravel,node js,php
     * @bodyParam locale_code string nullable Code Locale For translations. Example: id
     *
     */
    public function createPortoTranslate(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'required|string',
                'short_desc' => 'required|string',
                'description' => 'required|string',
                'photo' => 'nullable|file',
                'link' => 'nullable|string',
                'tags_value' => 'required|string',
                'locale_code' => 'nullable',
            ]);
            if($validator->fails()){
                return $this->sendApiError($validator->errors()->first(), 400);
            }

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
            $porto = MPorto::create($data);

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
                        'porto_id' => $porto->translate($locale)->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
            
            DB::commit();

            if($request->file('photo')){
                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->translate($locale)->id.'.'.$extension); 
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

    /**
     * Update Porto Translation
     * 
     * @bodyParam title string required Title Of the Porto. Example: Judul porto
     * @bodyParam short_desc string required Short Description. Example: Short Descript
     * @bodyParam description string required Full Description. Example: Long Descriptions
     * @bodyParam photo file nullable Image of the Porto.
     * @bodyParam link string nullable Links To Portofolio. Example: https://cloudias.my.id
     * @bodyParam tags_value string required Tags Tech For Portofolio separate by comma. Example: laravel,node js,php
     * @bodyParam locale_code string nullable Code Locale For translations. Example: id
     *
     */
    public function updatePortoTranslate($portoId, Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'nullable|string',
                'short_desc' => 'nullable|string',
                'description' => 'nullable|string',
                'photo' => 'nullable|image',
                'link' => 'nullable|string',
                'tags_value' => 'nullable|string',
                'locale_code' => 'nullable',
            ]);

            if($validator->fails()){
                return $this->sendApiError($validator->errors()->first(), 400);
            }
            
            $user = auth()->user();
            $locale = $request->locale_code ?? 'id';
            DB::beginTransaction();
            $porto = MPorto::find($portoId);
            
            if(!$porto){
                return $this->sendApiError('Porto Tidak Ditemukan', 400);
            }
            
            if($request->tags_value){
                $tags = explode(',', $request->tags_value);
                $tagsPortoCurrent = TagPorto::where('porto_id', $porto->translate($locale)->id)->delete();
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
                        'porto_id' => $porto->translate($locale)->id,
                        'tag_id' => $tag->id,
                    ]);
                }
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
            $porto->update($data_update);      
                  
            DB::commit();
            if($request->file('photo')){
                $porto = Porto::find($portoId);
                $previousPath = $porto->photo;

                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->translate($locale)->id.'.'.$extension);   
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
}
