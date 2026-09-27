<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // table => [fk_column, fk_index_name, composite_index_name]
        $tables = [
            'pf_custom_field_options_translations' => ['pf_custom_field_options_id', 'idx_pf_cfo_trans_fk', 'idx_pf_cfo_trans_fk_lang'],
            'pf_custom_fields_translations' => ['pf_custom_fields_id', 'idx_pf_cf_trans_fk', 'idx_pf_cf_trans_fk_lang'],
            'pf_packages_translations' => ['pf_packages_id', 'idx_pf_packages_trans_fk', 'idx_pf_packages_trans_fk_lang'],
            'pf_projects_translations' => ['pf_projects_id', 'idx_pf_projects_trans_fk', 'idx_pf_projects_trans_fk_lang'],
            'pf_service_categories_translations' => ['pf_service_categories_id', 'idx_pf_svc_cat_trans_fk', 'idx_pf_svc_cat_trans_fk_lang'],
            'pf_services_translations' => ['pf_services_id', 'idx_pf_services_trans_fk', 'idx_pf_services_trans_fk_lang'],
        ];

        foreach ($tables as $table => $config) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            [$foreignKey, $fkIndex, $compositeIndex] = $config;

            Schema::table($table, function (Blueprint $blueprint) use ($foreignKey, $fkIndex, $compositeIndex) {
                $blueprint->index($foreignKey, $fkIndex);
                $blueprint->index([$foreignKey, 'lang_code'], $compositeIndex);
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'pf_custom_field_options_translations' => ['idx_pf_cfo_trans_fk', 'idx_pf_cfo_trans_fk_lang'],
            'pf_custom_fields_translations' => ['idx_pf_cf_trans_fk', 'idx_pf_cf_trans_fk_lang'],
            'pf_packages_translations' => ['idx_pf_packages_trans_fk', 'idx_pf_packages_trans_fk_lang'],
            'pf_projects_translations' => ['idx_pf_projects_trans_fk', 'idx_pf_projects_trans_fk_lang'],
            'pf_service_categories_translations' => ['idx_pf_svc_cat_trans_fk', 'idx_pf_svc_cat_trans_fk_lang'],
            'pf_services_translations' => ['idx_pf_services_trans_fk', 'idx_pf_services_trans_fk_lang'],
        ];

        foreach ($tables as $table => $indexes) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($indexes) {
                $blueprint->dropIndex($indexes[0]);
                $blueprint->dropIndex($indexes[1]);
            });
        }
    }
};
