<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('monto_minimo_personal', 10, 2);
            $table->decimal('monto_minimo_directo', 10, 2);
            $table->decimal('monto_minimo_red', 10, 2);
            $table->bigInteger('numero_red');
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
        Schema::dropIfExists('niveles');
    }
}
