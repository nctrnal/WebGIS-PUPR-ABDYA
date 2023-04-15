<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Warna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'warna'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ]
        ]);
        $this->forge->addKey('warna', true);
        $this->forge->createTable('warna');
    }

    public function down()
    {
        $this->forge->dropTable('warna');
    }
}
