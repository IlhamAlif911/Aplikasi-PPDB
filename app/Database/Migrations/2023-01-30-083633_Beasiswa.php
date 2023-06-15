<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Beasiswa extends Migration
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
            'id_siswa'          => [
				'type'           => 'INT',
				'constraint'     => '5',
                'unsigned'       => true,
			],
            'keterangan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
            'jenis_beasiswa'     => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'tanggal_mulai'     => [
				'type'           => 'DATE'
			],
            'tanggal_selesai'     => [
				'type'           => 'DATE'
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_siswa', 'data_pendaftar', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('beasiswa', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('beasiswa');
    }
}
