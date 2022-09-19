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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Judges::class, 'judge_id');
            $table->foreignIdFor(\App\Models\Criteria::class, 'criteria_id');
            $table->foreignIdFor(\App\Models\Contest::class, 'contest_id');
            $table->foreignIdFor(\App\Models\Contestants::class, 'contestant_id');
            $table->double('score');
            $table->timestamps();
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
