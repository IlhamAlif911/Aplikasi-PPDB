<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriKode extends Migration
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

		// Membuat tabel news
		$this->forge->createTable('kategori_kode', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kategori_kode');
    }
}
