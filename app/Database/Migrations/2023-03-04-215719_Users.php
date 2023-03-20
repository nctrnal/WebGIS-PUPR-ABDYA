<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ]
        ]);
        $this->forge->addKey('username', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
