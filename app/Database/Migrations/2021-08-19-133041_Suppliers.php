<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'code'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'unique' => TRUE,
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
			],
			'address'       => [
				'type'           => 'TEXT',
			],
			'tlp'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'       	 => false,
			],
			'tlp2'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'       	 => true,
			],
			'fax'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'null'       	 => true,
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'unique' => TRUE,
				'null'       	 => false,
			],
			'note'       => [
				'type'           => 'TEXT',
				'null'       	 => true,
			],
			'is_active'       => [
				'type'           => 'BOOLEAN',
				'null'       	 => false,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			]

		]);
		$this->forge->addPrimaryKey('id', true);
		$this->forge->createTable('suppliers');
	}

	public function down()
	{
		$this->forge->dropTable('suppliers');
	}
}
