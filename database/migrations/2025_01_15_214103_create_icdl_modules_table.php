<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return  new class  extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icdl_modules', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_available')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('icdl_modules', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('icdl_modules');
    }
};
