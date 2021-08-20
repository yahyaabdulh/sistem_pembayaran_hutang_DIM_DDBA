<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchaseDetails extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'header_id'          => [
				'type'           => 'BIGINT',
			],
			'item_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '225',
			],
			'qty'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'price'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'disc_percent_d'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'disc_amount_d'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'total_price'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
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
		$this->forge->createTable('purchase_details');
	}

	public function down()
	{
		$this->forge->dropTable('purchase_details');
	}
}
