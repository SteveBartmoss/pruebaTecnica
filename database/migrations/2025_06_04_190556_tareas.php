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
        Schema::create('tarea',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('title',150);
            $table->boolean('completed');
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('proyectos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea');
    }
};
