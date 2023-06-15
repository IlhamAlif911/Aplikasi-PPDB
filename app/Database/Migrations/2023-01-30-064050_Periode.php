<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Periode extends Migration
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
            'nama_periode'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
            'tanggal_mulai'      => [
				'type'           => 'DATE'
			],
            'tanggal_selesai'      => [
				'type'           => 'DATE'
			],
			'status' => [
				'type'           => 'ENUM',
				'constraint'     => ['aktif', 'tidak_aktif']
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('periode', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('periode');
    }
}
