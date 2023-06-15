<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Data_Pendaftar extends Migration
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
			'nama_lengkap'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'nisn'      => [
				'type'           => 'VARCHAR',
				'constraint'     => '15'
			],
			'nik' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
            'temat_lahir' => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
            'tanggal_lahir' => [
				'type'           => 'DATE'
			],
            'nomor_akta' => [
				'type'           => 'VARCHAR',
				'constraint'     => '30'
			],
            'jenis_kelamin' => [
				'type'           => 'ENUM',
				'constraint'     => ['l', 'p']
			],
			'agama' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'kewarganegaraan' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'berkebutuhan_khusus' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'alamat' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100'
			],
			'kelurahan' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
            'kecamatan' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
            'kabupaten' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
            'provinsi' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'kode_pos' => [
				'type'           => 'VARCHAR',
				'constraint'     => '10'
			],
			'rt' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'rw' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'tempat_tinggal' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'moda_transportasi' => [
				'type'           => 'int',
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
			'tinggi_badan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'berat_badan' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'jarak_tinggal' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'waktu_tempuh' => [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'anak_ke' => [
				'type'           => 'VARCHAR',
				'constraint'     => '3'
			],
			'jumlah_saudara' => [
				'type'           => 'VARCHAR',
				'constraint'     => '3'
			],
			'asal_sekolah' => [
				'type'           => 'VARCHAR',
				'constraint'     => '30'
			],
            'nomor_seri_ijazah' => [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
            'nomor_seri_skhus' => [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
			'status_penerimaan' => [
				'type'           => 'int',
				'constraint'     => '3'
			],
			'foto' => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('data_pendaftar', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('data_pendaftar');
    }
}
