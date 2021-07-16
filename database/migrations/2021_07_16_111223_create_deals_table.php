<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('basic_account');
            $table->string('basic_listing');
            $table->string('basic_summary_description');
            $table->text('basic_description');
            $table->string('basic_conditions');
            $table->json('basic_keywords');
            $table->string('basic_mapinfo');

            $table->string('deal_start_date');
            $table->string('deal_end_date');

            $table->string('seo_title')->nullable();
            $table->string('seo_page_name')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();

            $table->string('image_logo')->nullable();
            $table->string('image_cover')->nullable();

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
        Schema::dropIfExists('deals');
    }
}
