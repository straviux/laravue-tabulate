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
        Schema::table('news', function (Blueprint $table) {
            //


            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->string('headline', 1000);
            $table->string('excerpt', 1000);
            $table->string('slug', 1000);
            $table->text('content', 25000);
            $table->string('cover_photo', 255)->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('featured');
            $table->dateTime('posted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
