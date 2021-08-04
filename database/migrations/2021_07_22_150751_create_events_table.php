<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('level');

            $table->json('basic_categories')->nullable();
            $table->string('basic_account')->nullable();
            $table->string('basic_status')->nullable();
            $table->date('basic_renewal_date')->nullable();
            $table->text('basic_summary_desc')->nullable();
            $table->text('basic_description')->nullable();
            $table->json('basic_keywords')->nullable();
            $table->string('social_facebook')->nullable();

            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('contact_venue')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_zip_code')->nullable();
            $table->string('contact_region')->nullable();

            $table->string('event_start_date')->nullable();
            $table->string('event_end_date')->nullable();
            $table->json('event_start_time')->nullable();
            $table->json('event_end_time')->nullable();
            $table->string('event_recurring_event')->nullable();
            $table->string('event_recurring_repeat')->nullable();
            $table->json('event_recurring_every')->nullable();
            $table->string('event_recurring_ends_on')->nullable();
            $table->json('event_recurring_dayofweek')->nullable();
            $table->string('event_recurring_ends_on_until')->nullable();

            $table->string('seo_title')->nullable();
            $table->string('seo_page_name')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();

            $table->string('image_cover')->nullable();
            $table->json('image_gallery')->nullable();
            $table->string('video_url')->nullable();

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
        Schema::dropIfExists('events');
    }
}
