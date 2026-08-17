<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('organization_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title',200);
            $table->string('slug',240)->unique();
            $table->text('description');
            $table->json('metadata')->nullable();
            $table->unsignedSmallInteger('year');
            $table->string('format',30);
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('downloads')->default(0);
            $table->enum('status',['published','draft'])->default('published');
            $table->timestamps();
            $table->index(['status','year']);
        });
    }
    public function down(){ Schema::dropIfExists('datasets'); }
};