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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en')->nullable(); 
            $table->string('title_ar')->nullable(); 
            $table->string('slug');
            $table->string('url')->nullable();
            $table->string('btn_text_en')->nullable(); 
            $table->string('btn_text_ar')->nullable();          
            $table->string('image')->nullable();
            $table->string('video')->nullable(); 
            $table->integer('parent_page')->nullable();
            $table->integer('parent_section')->nullable();
            $table->tinyInteger('display_order');
            $table->tinyInteger('content_level')->default('1');   
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
