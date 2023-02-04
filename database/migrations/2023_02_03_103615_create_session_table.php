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
        Schema::create('session', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('workout_id')
                ->constrained('workout')
                ->onDelete('cascade');
            $table->foreignUuid('organisation_id')
                ->constrained('organisation')
                ->onDelete('cascade');
            $table->foreignUuid('used_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->date('scheduled');
            $table->time('start');
            $table->time('end');
            $table->string('status')->default('pending');
            $table->tinyInteger('capacity');
            $table->tinyInteger('used');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('session');
    }
};
