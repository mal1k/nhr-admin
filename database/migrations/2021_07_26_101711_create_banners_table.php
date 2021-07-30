<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            $table->string('banner_type')->nullable();
            $table->string('caption', 25)->nullable();

            $table->string('description_line', 30)->nullable();
            $table->string('description_line2', 30)->nullable();

            $table->string('basic_account')->nullable();
            $table->string('basic_status')->nullable();
            $table->date('basic_renewal_date')->nullable();

            $table->string('banner_section')->nullable();
            $table->string('banner_category')->nullable();

            $table->string('general_category')->nullable();
            $table->string('listing_deals_category')->nullable();
            $table->string('event_category')->nullable();
            $table->string('blog_category')->nullable();
            $table->string('global_category')->nullable();
            $table->boolean('banner_new_window')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('banner_script_checkbox')->nullable();
            $table->text('banner_script_textarea')->nullable();
            $table->string('banner_destinational_url')->nullable();
            $table->string('banner_display_url', 30)->nullable();

            $table->string('promotional_code')->nullable();

            $table->string('file_image')->nullable();

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
        Schema::dropIfExists('banners');
    }
}
