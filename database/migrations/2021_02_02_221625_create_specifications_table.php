<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->integer('height')->nullable();
            $table->text('available');
            $table->text('gender');
            $table->text('color');
            $table->text('religion');
            $table->text('ocupation')->nullable();
            $table->text('CPF')->nullable();
            $table->text('RG')->nullable();
            $table->text('otherdoc')->nullable();
            $table->smallInteger('active')->default('1');
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
        Schema::dropIfExists('specifications');
    }
}
