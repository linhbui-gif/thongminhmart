<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMetaSizeAndMetaColorTableProductProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_products', function (Blueprint $table) {
            $table->text('meta_size')->nullable();
            $table->text('meta_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_products', function (Blueprint $table) {
            $table->dropColumn(['meta_size', 'meta_color']);
        });
    }
}
