<?php

use App\Enums\CategoryType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->string('phone');
            $table->string('company');
            $table->string('address');
            $table->string('website');
            $table->string('description');
            $table->enum('category', CategoryType::values())->default(CategoryType::INDONESIAN);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('avatar')->nullable();
            $table->string('backdrop')->nullable();
            $table->foreignUlid('user_id')->index()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
