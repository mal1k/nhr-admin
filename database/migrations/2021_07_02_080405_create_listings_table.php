<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level');
            $table->json('basic_categories')->nullable();
            $table->string('basic_account')->nullable();
            $table->string('basic_status')->nullable();
            $table->date('basic_renewal_date')->nullable();
            $table->string('basic_disable_claim')->nullable();
            $table->string('basic_summary_desc')->nullable();
            $table->string('image_logo')->nullable();
            $table->json('basic_keywords')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_address2')->nullable();
            $table->string('contact_zip_code')->nullable();
            $table->string('contact_map_info')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_page_name')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('promotional_code')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
