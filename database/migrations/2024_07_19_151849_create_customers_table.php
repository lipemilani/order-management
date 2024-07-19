<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 20);
            $table->timestamps('date_of_birth');
            $table->string('address', 200);
            $table->string('complement', 60);
            $table->string('neighborhood', 60);
            $table->string('cep', 10);
            $table->timestamps('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
