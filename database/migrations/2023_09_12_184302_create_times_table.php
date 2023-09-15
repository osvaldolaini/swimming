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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teams_configs_id')->constrained();
            $table->foreignId('athlete_id')->constrained();
            $table->foreignId('modality_id')->constrained();
            $table->date('day')->nullable();
            $table->integer('pool')->nullable();
            $table->integer('distance')->nullable();
            $table->string('type_time',100)->nullable();
            $table->decimal('record',10,2)->nullable();
            $table->string('recordConverte',30)->nullable();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('times');
    }
};
