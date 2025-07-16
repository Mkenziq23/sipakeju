<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosa', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('no_hp', 13);
            $table->longText('alamat');
            // $table->char('penyakit_id', 4);
            $table->string('tingkat_kecenderungan');
            $table->float('presentase');
            $table->timestamps();

            // $table->foreign('penyakit_id')->references('id')->on('penyakit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosa');
    }
}
