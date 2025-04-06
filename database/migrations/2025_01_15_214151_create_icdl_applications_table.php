<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icdl_applications', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('icdl_module_id')->nullable()->references('id')->on('icdl_modules');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('icdl_applications');
    }
};
