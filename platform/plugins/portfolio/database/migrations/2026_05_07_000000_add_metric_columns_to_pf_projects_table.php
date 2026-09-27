<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('pf_projects', function (Blueprint $table): void {
            if (! Schema::hasColumn('pf_projects', 'metric_1_value')) {
                $table->string('metric_1_value', 32)->nullable();
            }
            if (! Schema::hasColumn('pf_projects', 'metric_1_label')) {
                $table->string('metric_1_label', 120)->nullable();
            }
            if (! Schema::hasColumn('pf_projects', 'metric_2_value')) {
                $table->string('metric_2_value', 32)->nullable();
            }
            if (! Schema::hasColumn('pf_projects', 'metric_2_label')) {
                $table->string('metric_2_label', 120)->nullable();
            }
            if (! Schema::hasColumn('pf_projects', 'metric_3_value')) {
                $table->string('metric_3_value', 32)->nullable();
            }
            if (! Schema::hasColumn('pf_projects', 'metric_3_label')) {
                $table->string('metric_3_label', 120)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pf_projects', function (Blueprint $table): void {
            $columns = ['metric_1_value', 'metric_1_label', 'metric_2_value', 'metric_2_label', 'metric_3_value', 'metric_3_label'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('pf_projects', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
