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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('sex',20)->nullable();
            $table->string('name',100)->nullable();
            $table->string('nick',30)->nullable();
            $table->date('birth')->nullable();
            $table->string('slug')->nullable();
            $table->string('code')->nullable();
            $table->integer('register')->nullable();
            $table->date('register_date')->nullable();
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
