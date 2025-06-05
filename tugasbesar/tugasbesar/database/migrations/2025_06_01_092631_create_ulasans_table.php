<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ulasans')) {
            Schema::create('ulasans', function (Blueprint $table) {
                $table->id();
                $table->string('nama_rumah_makan');
                $table->string('nama_pengulas');
                $table->integer('rating');
                $table->text('komentar')->nullable(); // Sesuai validasi di controller
                $table->timestamps(); // created_at dan updated_at
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ulasans');
    }
};