<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('title');
            $table->text('body');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');

        $directories = collect(Storage::disk('public')->allDirectories('news'));
        // Izbrisemo vse direktorije in slike iz njih.
        $directories->each(function($directory) {
            Storage::disk('public')->deleteDirectory($directory);
        });
    }
}
