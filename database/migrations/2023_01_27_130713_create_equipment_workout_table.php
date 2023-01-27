<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_workout', function (Blueprint $table) {
            $table->foreignUuid('equipment_id')
                ->constrained('equipment')
                ->onDelete('cascade');
            $table->foreignUuid('workout_id')
                ->constrained('workout')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_workout');
    }
};
