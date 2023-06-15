<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataOrangTua extends Migration
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
            'jenis_orang_tua'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '3'
			],
			'nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'nik' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
            'tahun_lahir' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
            'pendidikan'          => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'pekerjaan'          => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
            'penghasilan_bulanan'          => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
			'berkebutuhan_khusus'          => [
				'type'           => 'INT',
				'constraint'     => '3'
			],
			'nomor_hp' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'alamat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_siswa', 'data_pendaftar', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('data_orang_tua', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('data_orang_tua');
    }
}
