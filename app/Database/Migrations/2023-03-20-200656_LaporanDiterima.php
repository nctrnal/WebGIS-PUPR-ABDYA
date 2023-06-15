<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanDiterima extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelaporan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pelapor'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'pelapor'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'lokasi'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jenis_kerusakan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'deskripsi'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '1000',
            ],
            'koordinat'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '1000',
            ],
            'bukti'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id_pelaporan');
        $this->forge->createTable('laporanDiterima');
    }

    public function down()
    {
        $this->forge->dropTable('laporanDiterima');
    }
}
