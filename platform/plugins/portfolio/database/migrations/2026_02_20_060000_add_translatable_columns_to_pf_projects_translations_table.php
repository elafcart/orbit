<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('pf_projects_translations', function (Blueprint $table): void {
            $table->string('place', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->string('client', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pf_projects_translations', function (Blueprint $table): void {
            $table->dropColumn(['place', 'author', 'client']);
        });
    }
};
