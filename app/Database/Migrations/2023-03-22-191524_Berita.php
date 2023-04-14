<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Berita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berita'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'penulis'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kategori'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'body'       => [
                'type'           => 'TEXT',
                //kalo migrasi nya gagal, ganti aja type nya jadi VARCHAR, trus constraint nya jangan comment
                // 'constraint'     => '1000000',
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
        $this->forge->addPrimaryKey('id_berita');
        $this->forge->createTable('berita');
    }

    public function down()
    {
        $this->forge->dropTable('berita');
    }
}
