<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại bài viết
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            // Khóa ngoại user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // cột comment
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('content');
            $table->tinyInteger('status')->default(0)->comment('1: active, 0: hidden, -1: reported');
            $table->timestamps();

            // Đệ quy chính nó cho chức năng trả lời comment
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
