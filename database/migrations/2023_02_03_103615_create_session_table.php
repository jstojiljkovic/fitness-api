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
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->string('status')->default('pending');
            $table->tinyInteger('capacity')->default(1);
            $table->tinyInteger('used')->default(0);
            $table->string('remark',200)->default('');
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
