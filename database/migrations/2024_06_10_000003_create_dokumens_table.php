<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->string('judul_dokumen');
            $table->text('deskripsi');
            $table->text('file_url');
            $table->date('tanggal_upload');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumens');
    }
};
