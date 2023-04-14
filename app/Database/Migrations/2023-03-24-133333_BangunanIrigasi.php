<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BangunanIrigasi extends Migration
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
            'luas'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'kecamatan'       => [
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
        $this->forge->createTable('bangunanIrigasi');
    }

    public function down()
    {
        $this->forge->dropTable('bangunanIrigasi');
    }
}
