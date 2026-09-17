<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            // Identifies one guest's conversation thread. Stored in a
            // long-lived cookie on the visitor's browser (see ChatController).
            $table->string('session_id')->index();
            $table->enum('sender_type', ['guest', 'admin']);
            $table->string('sender_name')->nullable();
            $table->text('body');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
