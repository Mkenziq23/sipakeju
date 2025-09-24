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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('no_hp', 13);
            $table->longText('alamat');
            $table->string('pakar')->nullable();
            $table->json('kondisi');
            $table->longText('deskripsi')->nullable();
            $table->text('solusi')->nullable();
            $table->string('tingkat_kecenderungan');
            $table->float('presentase');
            $table->string('status')->nullable();
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
