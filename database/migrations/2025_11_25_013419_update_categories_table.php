<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Đổi tên cột order → status
            $table->renameColumn('order', 'status');

            // Thêm cột thumbnail sau description
            $table->string('thumbnail')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('categories', function (Blueprint $table) {
            // Đổi lại tên status → order
            $table->renameColumn('status', 'order');

            // Xóa cột thumbnail
            $table->dropColumn('thumbnail');
        });
    }
};
