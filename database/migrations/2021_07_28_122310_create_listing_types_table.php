<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_types', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->json('categories')->nullable();
            $table->float('additional_price')->nullable();

            $table->string('common_fields_listing_title_label')->nullable();
            $table->string('common_fields_listing_title_tooltip')->nullable();
            $table->string('common_fields_address_line_label')->nullable();
            $table->string('common_fields_address_line_tooltip')->nullable();
            $table->string('common_fields_address_line2_label')->nullable();
            $table->string('common_fields_address_line2_tooltip')->nullable();

            $table->string('extra_checkbox_fields_label')->nullable();
            $table->string('extra_checkbox_fields_tooltip')->nullable();

            $table->string('extra_dropdown_fields_label')->nullable();
            $table->string('extra_dropdown_fields_dropdown_items')->nullable();
            $table->string('extra_dropdown_fields_tooltip')->nullable();
            $table->string('extra_dropdown_fields_checkbox')->nullable();

            $table->string('extra_text_fields_label')->nullable();
            $table->string('extra_text_fields_tooltip')->nullable();
            $table->string('extra_text_fields_checkbox')->nullable();

            $table->string('extra_short_description_fields_label')->nullable();
            $table->string('extra_short_description_fields_tooltip')->nullable();
            $table->string('extra_short_description_fields_checkbox')->nullable();

            $table->string('extra_long_description_fields_label')->nullable();
            $table->string('extra_long_description_fields_tooltip')->nullable();
            $table->string('extra_long_description_fields_checkbox')->nullable();

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
        Schema::dropIfExists('listing_types');
    }
}
