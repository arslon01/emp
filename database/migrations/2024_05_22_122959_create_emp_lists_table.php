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
        Schema::create('emp_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_dep_id');
            $table->unsignedBigInteger('emp_position_id');
            $table->string('full_name', 255);
            $table->timestamps();

            $table->foreign('emp_dep_id')
                ->references('id')
                ->on('emp_deps');
            $table->foreign('emp_position_id')
                ->references('id')
                ->on('emp_positions');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_lists');
    }
};
