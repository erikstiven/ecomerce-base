<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('company_settings', 'bank_deposit_enabled')) {
                $table->boolean('bank_deposit_enabled')->default(true)->after('payphone_api_url');
            }
            if (!Schema::hasColumn('company_settings', 'bank_name')) {
                $table->string('bank_name')->nullable()->after('bank_deposit_enabled');
            }
            if (!Schema::hasColumn('company_settings', 'bank_account_type')) {
                $table->string('bank_account_type')->nullable()->after('bank_name');
            }
            if (!Schema::hasColumn('company_settings', 'bank_account_number')) {
                $table->string('bank_account_number')->nullable()->after('bank_account_type');
            }
            if (!Schema::hasColumn('company_settings', 'bank_transfer_instructions')) {
                $table->text('bank_transfer_instructions')->nullable()->after('bank_account_number');
            }
            if (!Schema::hasColumn('company_settings', 'bank_whatsapp')) {
                $table->string('bank_whatsapp')->nullable()->after('bank_transfer_instructions');
            }
            if (!Schema::hasColumn('company_settings', 'bank_whatsapp_message')) {
                $table->string('bank_whatsapp_message')->nullable()->after('bank_whatsapp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $columns = [
                'bank_deposit_enabled',
                'bank_name',
                'bank_account_type',
                'bank_account_number',
                'bank_transfer_instructions',
                'bank_whatsapp',
                'bank_whatsapp_message',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('company_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
