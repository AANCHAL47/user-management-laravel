<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('cache')) {
            Schema::create('cache', function (Blueprint $table) {
                $table->id();
                $table->string('key');
                $table->text('value');
                $table->integer('expiration');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('cache');
    }

};
