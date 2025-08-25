<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_setting', function (Blueprint $table) {
            $table->id();

  
        $table->string('title', 100);
        $table->string('description', 200)->nullable();
        $table->string('content', 200)->nullable();

   
        $table->string('facebook', 100)->nullable();
        $table->string('telegram', 100)->nullable();
        $table->string('youtube', 100)->nullable();

     
        $table->string('logo', 255)->nullable();

     
        $table->timestamps();
        $table->softDeletes();

        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_setting');
    }
};
