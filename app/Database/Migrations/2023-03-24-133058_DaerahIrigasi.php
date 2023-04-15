<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DaerahIrigasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'lebar_bawah'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'lebar_atas'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'keterangan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kecamatan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kondisi'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'warna'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'json'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'foto'       => [
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
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('daerahIrigasi');
    }

    public function down()
    {
        $this->forge->dropTable('daerahIrigasi');
    }
}
