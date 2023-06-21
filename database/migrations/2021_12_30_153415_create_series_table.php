<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained('inventories')->references('id')->cascadeOnDelete();
            $table->json("series");
            $table->string("status");
            $table->dateTime('run_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('series',function (Blueprint $table){
            $table->dropForeign('series_inventory_id_foreign');
            $table->dropForeign('series_playbook_id_foreign');
        });
        Schema::dropIfExists('series');
    }
}
