<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_categories', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->json('categories')->nullable();

            $table->string('features_checkbox')->nullable();
            $table->string('disable_checkbox')->nullable();

            $table->string('main_category')->nullable();

            $table->text('content')->nullable();

            $table->string('seo_page_title')->nullable();
            $table->string('seo_friendly_title')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();

            $table->string('image_logo')->nullable();
            $table->string('image_icon')->nullable();

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
        Schema::dropIfExists('listing_categories');
    }
}
