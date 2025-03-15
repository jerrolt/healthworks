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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('message_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Message::class)->constrained('messages')->onDelete('cascade');
            // sha1 hash of id,  40 characters
            $table->string('secret')->index()->unique();
            $table->string('filename');
            $table->string('path');
            $table->string('mime');
            $table->string('extension'); // PDF, JPG, JPEG
            $table->integer('expires_at'); // time in seconds
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
