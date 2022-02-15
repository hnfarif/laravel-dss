<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('name', 100);
            $table->date('birthdate');
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->string('address', 100);
            $table->enum('religion', ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('marital_status', ['Belum Kawin', 'Sudah Kawin']);
            $table->string('job', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternatives');
    }
}
