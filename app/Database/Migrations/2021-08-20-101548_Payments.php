<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
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
			'date'       => [
				'type'           => 'DATETIME',
			],
			'supplier_id'       => [
				'type'           => 'BIGINT',
				'unsigned' => TRUE,
			],
			'bill_amount'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'paid_amount'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'status'       => [
				'type'           => 'TINYINT',
				'default'     =>  1,
			],
			'note'       => [
				'type'           => 'TEXT',
				'null'       	 => true,
			],
			'user_create'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'null'       	 => true,
			],
			'user_update'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
				'null'       	 => true,
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
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id');
		$this->forge->createTable('payments');
	}

	public function down()
	{
		$this->forge->dropTable('payments');
	}
}
