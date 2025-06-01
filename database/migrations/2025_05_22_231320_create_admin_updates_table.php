<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::create('admin_updates', function (Blueprint $table): void {
            $table->id();
            $table->string('model');
            $table->integer('model_id');
            $table->json('changes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_updates');
    }
};
