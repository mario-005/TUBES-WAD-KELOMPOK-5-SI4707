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
            Schema::create('menus', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('category', ['makanan', 'minuman']);
                $table->decimal('price', 8, 2);
                $table->string('image')->nullable();
                $table->text('description');
                $table->enum('status', ['available', 'out_of_stock'])->default('available');
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
