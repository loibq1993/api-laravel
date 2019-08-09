<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('image', 'feature_image');
            $table->renameColumn('active','status');
            $table->string('slug');
            $table->string('SKU');
            $table->unsignedBigInteger('supplier_id');
            $table->dropColumn('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->renameColumn('feature_image', 'image');
        $table->renameColumn('status','active');
        $table->dropColumn('slug');
        $table->dropColumn('SKU');
        $table->dropColumn('supplier_id');
        $table->integer('quantity')->default(0);
        $table->dropColumn('supplier_id');
    }
}
