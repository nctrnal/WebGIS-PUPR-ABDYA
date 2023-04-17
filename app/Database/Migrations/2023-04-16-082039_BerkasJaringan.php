<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BerkasJaringan extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id_berkas'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_daerah'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'pdf'       => [
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
        $this->forge->addPrimaryKey('id_berkas');
        $this->forge->createTable('berkas_jaringan');
    }

    public function down()
    {
        $this->forge->dropTable('berkas_jaringan');
    }
}
