<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('anaks', function (Blueprint $table) {
            $table->string('nama')->after('user_id');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('nama');
            $table->integer('umur_bulan')->after('jenis_kelamin');
            $table->float('berat', 4)->after('umur_bulan');
            $table->float('tinggi', 4)->after('berat');
            $table->float('lingkar_kepala', 4)->after('tinggi');
            $table->float('lingkar_lengan', 4)->after('lingkar_kepala');
            $table->string('kecamatan')->after('lingkar_lengan');
            $table->integer('jumlah_vit_a')->default(0)->after('kecamatan');
            $table->string('pendidikan_ayah')->after('jumlah_vit_a');
            $table->string('pendidikan_ibu')->after('pendidikan_ayah');
            $table->string('status_gizi')->after('pendidikan_ibu');
        });
    }

    public function down()
    {
        Schema::table('anaks', function (Blueprint $table) {
            $table->dropColumn([
                'nama',
                'jenis_kelamin',
                'umur_bulan',
                'berat',
                'tinggi',
                'lingkar_kepala',
                'lingkar_lengan',
                'kecamatan',
                'jumlah_vit_a',
                'pendidikan_ayah',
                'pendidikan_ibu',
                'status_gizi',
            ]);
        });
    }

};
