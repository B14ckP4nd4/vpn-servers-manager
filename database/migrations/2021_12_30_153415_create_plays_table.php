<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained('inventories')->references('id')->cascadeOnDelete();
            $table->foreignId('playbook_id')->constrained('playbooks')->references('id')->cascadeOnDelete();
            $table->integer('ok')->default(0)->unsigned();
            $table->integer('changed')->default(0)->unsigned();
            $table->integer('unreachable')->default(0)->unsigned();
            $table->integer('failed')->default(0)->unsigned();
            $table->integer('skipped')->default(0)->unsigned();
            $table->integer('rescued')->default(0)->unsigned();
            $table->integer('ignored')->default(0)->unsigned();
            $table->boolean('completed')->default(0);
            $table->boolean('is_running')->default(0);
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
        Schema::table('plays',function (Blueprint $table){
            $table->dropForeign('plays_inventory_id_foreign');
            $table->dropForeign('plays_playbook_id_foreign');
        });
        Schema::dropIfExists('plays');
    }
}
