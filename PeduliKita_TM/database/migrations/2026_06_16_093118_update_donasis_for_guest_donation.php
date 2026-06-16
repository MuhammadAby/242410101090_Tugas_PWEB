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
        Schema::table('donasis', function (Blueprint $table) {

            // hapus relasi donatur login
            $table->dropForeign(['donatur_id']);
            $table->dropColumn('donatur_id');

            // ubah nama jumlah → nominal
            $table->renameColumn('jumlah', 'nominal');

            // data donatur umum
            $table->string('nama')->after('id');

            $table->string('email')->after('nama');

            $table->string('metode')
                  ->after('nominal');

            $table->text('pesan')
                  ->nullable()
                  ->after('metode');

            $table->string('bukti_transfer')
                  ->nullable()
                  ->after('pesan');

            // ubah status
            $table->enum('status', [
                'pending',
                'terverifikasi',
                'ditolak'
            ])->default('pending')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {

            $table->foreignId('donatur_id')
                  ->nullable();

            $table->renameColumn('nominal', 'jumlah');

            $table->dropColumn([
                'nama',
                'email',
                'metode',
                'pesan',
                'bukti_transfer',
            ]);

        });
    }
};
