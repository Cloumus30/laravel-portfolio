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
            $data = MPorto::selectRaw("id, to_char(created_at, 'YYYY/MM/DD') as date")->orderBy('created_at', 'asc')->get()
            ->groupBy('date')->transform(function($value){
                    return count($value);
                });
            return response()->view('pages.admin.dashboard', ["data" => $data]);
        } catch (\Throwable $th) {
            return response()->view('pages.admin.dashboard');
        }
    }
}
