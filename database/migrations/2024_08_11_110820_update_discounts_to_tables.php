<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->integer('discount')->nullable()->change();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('discount')->nullable()->change();
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->integer('discount')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        // Schema::table('subscriptions', function (Blueprint $table) {
        //     $table->dropColumn('discount');
        // });

        // Schema::table('lessons', function (Blueprint $table) {
        //     $table->dropColumn('discount');
        // });

        // Schema::table('collections', function (Blueprint $table) {
        //     $table->dropColumn('discount');
        // });
    }
};
