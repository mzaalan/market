<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMobileDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id', 40);
            $table->string('device_token', 512);
            $table->string('mobile_no', 20)->nullable();
            $table->string('device_os', 10);
            $table->string('os_version', 10);
            $table->string('app_version', 10);
            $table->boolean('active')->default(true);
            $table->nullableTimestamps();
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
        Schema::drop('mobile_devices');
    }
}
