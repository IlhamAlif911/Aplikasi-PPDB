<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AppSetting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'             => ['type' => 'varchar', 'constraint' => 255],
            'name'             => ['type' => 'varchar', 'constraint' => 255],
            'value'            => ['type' => 'json'],
            'status'           => ['type' => 'boolean', 'default' => true],
            'is_global'        => ['type' => 'boolean', 'default' => false],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('app_setting');

    }

    public function down()
    {
        $this->forge->dropTable('app_setting');
    }
}
