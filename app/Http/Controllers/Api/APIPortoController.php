<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Porto;
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
            
            DB::commit();

            if($request->file('photo')){
                $file = $request->file('photo');
                $extension = $file->extension();
                $path = $file->storeAs('./porto','Porto-'.$porto->id.'.'.$extension); 
                DB::beginTransaction();
                $porto->update(['photo'=> $path]);
                DB::commit();
            }
            
            return $this->sendApiResponse(null, 'success Input Data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendApiError($th->getMessage(), 400);
        }
    }
}
