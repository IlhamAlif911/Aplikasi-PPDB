<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tahap extends Migration
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
            'id_periode'      => [
				'type'           => 'INT',
				'constraint'     => '3',
                'unsigned'       => true
			],
            'nama_tahap'      => [
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
        $this->forge->addForeignKey('id_periode', 'periode', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('tahap', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tahap');
    }
}
