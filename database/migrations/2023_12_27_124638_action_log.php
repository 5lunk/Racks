<?php

declare(strict_types=1);

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
        Schema::create('action_log', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->longText('context');
            $table->string('level')->index();
            $table->string('level_name');
            $table->string('channel')->index();
            $table->string('record_datetime');
            $table->longText('extra');
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_log');
    }
};
