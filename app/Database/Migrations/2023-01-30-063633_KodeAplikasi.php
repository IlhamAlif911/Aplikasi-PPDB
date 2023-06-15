<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KodeAplikasi extends Migration
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
            'id_kategori'      => [
				'type'           => 'INT',
				'constraint'     => '3',
                'unsigned'       => true
			],
			'nama_kategori'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'status' => [
				'type'           => 'ENUM',
				'constraint'     => ['on', 'off']
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_kategori', 'kategori_kode', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel news
		$this->forge->createTable('kode_aplikasi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kode_aplikasi');
    }
}
