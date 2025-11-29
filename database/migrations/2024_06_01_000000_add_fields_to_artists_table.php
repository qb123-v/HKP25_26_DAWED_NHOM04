<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToArtistsTable extends Migration
{
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            if (!Schema::hasColumn('artists', 'email')) $table->string('email')->nullable()->unique();
            if (!Schema::hasColumn('artists', 'phone')) $table->string('phone')->nullable();
            if (!Schema::hasColumn('artists', 'dob')) $table->date('dob')->nullable();
            if (!Schema::hasColumn('artists', 'address')) $table->string('address')->nullable();
            if (!Schema::hasColumn('artists', 'intro')) $table->text('intro')->nullable();
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            if (Schema::hasColumn('artists', 'email')) $table->dropColumn('email');
            if (Schema::hasColumn('artists', 'phone')) $table->dropColumn('phone');
            if (Schema::hasColumn('artists', 'dob')) $table->dropColumn('dob');
            if (Schema::hasColumn('artists', 'address')) $table->dropColumn('address');
            if (Schema::hasColumn('artists', 'intro')) $table->dropColumn('intro');
        });
    }
}
