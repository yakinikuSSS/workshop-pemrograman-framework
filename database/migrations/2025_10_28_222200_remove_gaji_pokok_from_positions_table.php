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
    Schema::table('positions', function (Blueprint $table) {
        $table->dropColumn('gaji_pokok');
    });
}


    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('positions', function (Blueprint $table) {
        $table->decimal('gaji_pokok', 10, 2)->nullable();
    });
}

};
