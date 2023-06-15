<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jalur extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'id_tahap'      => [
				'type'           => 'INT',
				'constraint'     => '3',
                'unsigned'       => true
			],
            'nama_jalur'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
            'kuota'      => [
				'type'           => 'INT',
                'constraint'     => '3'
			],
			'status' => [
				'type'           => 'ENUM',
				'constraint'     => ['aktif', 'tidak_aktif']
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_tahap', 'tahap', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('jalur', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('jalur');
    }
}
