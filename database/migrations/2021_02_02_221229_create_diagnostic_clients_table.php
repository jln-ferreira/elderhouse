<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_clients', function (Blueprint $table) {
            $table->id();
            $table->integer('diagnostic_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->date('date');
            $table->text('comments');
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
        Schema::dropIfExists('diagnostic_clients');
    }
}
