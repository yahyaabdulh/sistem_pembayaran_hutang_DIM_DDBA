<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentDetails extends Migration
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
			'purchase_id'       => [
				'type'           => 'BIGINT',
				'unsigned' => TRUE,
			],
			'bill'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'bill_payment'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'bill_remain'       => [
				'type'           => 'DOUBLE',
				'default'     =>  0,
			],
			'note'       => [
				'type'           => 'TEXT',
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
		$this->forge->addForeignKey('purchase_id', 'purchases', 'id');
		$this->forge->createTable('payment_details');
	}

	public function down()
	{
		$this->forge->dropTable('payment_details');
	}
}
