<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('elafcart_items')) {
            Schema::create('elafcart_items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();
                $table->string('image')->nullable();
                $table->string('status', 60)->default('published');
                $table->integer('order')->default(0);
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('elafcart_items_translations')) {
            Schema::create('elafcart_items_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('elafcart_items_id');
                $table->string('name')->nullable();
                $table->string('description', 400)->nullable();
                $table->longText('content')->nullable();

                $table->primary(['lang_code', 'elafcart_items_id'], 'elafcart_items_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('elafcart_items_translations');
        Schema::dropIfExists('elafcart_items');
    }
};
