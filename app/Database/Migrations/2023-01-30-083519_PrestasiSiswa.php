<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrestasiSiswa extends Migration
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
            'nama_prestasi'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
            'jenis_prestasi'     => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'tingkat_prestasi'     => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'tahun'     => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
            'penyelenggara'     => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
            'peringkat'     => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'nilai_bobot'      => [
				'type'           => 'INT',
				'constraint'     => '3',
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_siswa', 'data_pendaftar', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('prestasi_siswa', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('prestasi_siswa');
    }
}
