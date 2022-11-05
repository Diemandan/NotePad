<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('notes', 'user_id')) {
            
        }else {Schema::table('notes', function (Blueprint $table) {
            $table->integer('user_id')->after('id');
        });}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('notes', 'user_id')) {
            Schema::table('notes', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
