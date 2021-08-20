<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RevUsers extends Migration
{
	public function up()
	{
		$fields = array(
			'address' => array(
				'type' => 'TEXT',
			),
			'tlp' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'unique' => TRUE,
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'unique' => TRUE,
			)
		);
		$this->forge->addColumn('users', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('users', 'address');
		$this->forge->dropColumn('users', 'tlp');
		$this->forge->dropColumn('users', 'email');
	}
}
