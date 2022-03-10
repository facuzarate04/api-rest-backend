<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_turns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('min_turn_duration');
            $table->decimal('max_turn_duration');
            $table->time('start_work_at');
            $table->time('end_work_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_turns');
    }
};
