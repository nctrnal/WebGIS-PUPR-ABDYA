<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JaringanIrigasi extends Migration
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
            'panjang'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'kondisi'       => [
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
        $this->forge->createTable('jaringanIrigasi');
    }

    public function down()
    {
        $this->forge->dropTable('jaringanIrigasi');
    }
}
