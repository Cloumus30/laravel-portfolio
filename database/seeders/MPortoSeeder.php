<?php

namespace Database\Seeders;

use App\Models\MPorto;
use App\Models\Porto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MPortoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portos = Porto::get();
        foreach ($portos as $key => $value) {
            $mPorto = MPorto::create([
                'user_id' => $value->user_id,
            ]);
            $porto = Porto::find($value->id);
            $porto->update([
                'm_porto_id' => $mPorto->id,
                'locale' => 'id'
            ]);
        }
    }
}
