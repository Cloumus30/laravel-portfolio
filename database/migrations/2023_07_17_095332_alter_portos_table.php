<?php

use App\Models\Porto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portos', function(Blueprint $table){
            $table->foreignId('m_porto_id')->nullable()->constrained('m_portos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('locale')->index()->nullable();
            $table->dropForeignIdFor(Porto::class, 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portos', function(Blueprint $table){
            $table->dropColumn('m_porto_id');
            $table->dropColumn('locale');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
