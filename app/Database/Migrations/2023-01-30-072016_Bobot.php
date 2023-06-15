<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BobotNilai extends Migration
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
            'nama_bobot'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'jenis_bobot'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '3',
			],
            'nilai_bobot'      => [
				'type'           => 'INT',
				'constraint'     => '3',
			],
			'status' => [
				'type'           => 'ENUM',
				'constraint'     => ['aktif', 'tidak_aktif']
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('bobot', TRUE);
    }

    public function down()
    {
		$this->forge->dropTable('bobot');
    }
}
