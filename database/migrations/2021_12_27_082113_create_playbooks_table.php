<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaybooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playbooks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('path')->nullable()->unique();
            $table->text('url')->nullable()->unique();
            $table->dateTime('last_updated_at')->nullable();
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
        Schema::dropIfExists('playbooks');
    }
}
