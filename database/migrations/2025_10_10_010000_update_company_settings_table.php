<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->text('footer_description')->nullable()->change();
            $table->string('footer_phone')->nullable()->after('footer_email');
            $table->string('footer_logo')->nullable()->after('footer_phone');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('footer_description')->nullable()->change();
            $table->dropColumn(['footer_phone', 'footer_logo']);
        });
    }
};
