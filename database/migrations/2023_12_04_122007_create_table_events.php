<?php

use App\Models\Place;
use App\Models\Subgenre;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->text('description');
            $table->string('image', 64);
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('age_limit_id');
            $table->foreign('age_limit_id')->references('id')->on('age_limits');
            $table->unsignedBigInteger('subgenre_id');
            $table->foreign('subgenre_id')->references('id')->on('subgenres');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
