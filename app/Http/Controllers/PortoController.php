<?php

namespace App\Http\Controllers;

use App\Models\Porto;
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
                'description' => 'nullable|string',
                'photo' => 'nullable|image',
                'link' => 'required|string',
            ]);
            
            $user = auth()->user();
            DB::beginTransaction();
            $porto = Porto::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $user->id,
                'link' => $request->link,
            ]);            
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
