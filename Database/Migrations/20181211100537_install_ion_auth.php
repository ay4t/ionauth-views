<?php
namespace IonauthView\Database\Migrations;

/*
 * File: 20181211100537_install_ion_auth.php
 * Project: Migrations
 * Created Date: We Dec 2021
 * Author: Ayatulloh Ahad R
 * Email: ayatulloh@indiega.net
 * Phone: 085791555506
 * -----
 * Last Modified: Fri Dec 03 2021
 * Modified By: Ayatulloh Ahad R
 * -----
 * Copyright (c) 2021 Indiega Network
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 * 
 * CodeIgniter IonAuth
 *
 * @package CodeIgniter-Ion-Auth
 * @author  Benoit VRIGNAUD <benoit.vrignaud@zaclys.net>
 * @license https://opensource.org/licenses/MIT	MIT License
 * @link    http://github.com/benedmunds/CodeIgniter-Ion-Auth
 */

/**
 * Migration class
 *
 * @package CodeIgniter-Ion-Auth
 */
class Migration_Install_ion_auth extends \CodeIgniter\Database\Migration
{
	/**
	 * Tables
	 *
	 * @var array
	 */
	private $tables;

	/**
	 * Construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$config = config('IonAuth');

		// initialize the database
		$this->DBGroup = empty($config->databaseGroupName) ? '' : $config->databaseGroupName;

		parent::__construct();

		$this->tables = $config->tables;
	}

	/**
	 * Up
	 *
	 * @return void
	 */
	public function up()
	{
		// Drop table 'groups' if it exists
		$this->forge->dropTable($this->tables['groups'], true);

		// Table structure for table 'groups'
		$this->forge->addField([
			'id' => [
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name' => [
				'type'       => 'VARCHAR',
				'constraint' => '20',
			],
			'description' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable($this->tables['groups']);

		// Drop table 'users' if it exists
		$this->forge->dropTable($this->tables['users'], true);

		// Table structure for table 'users'
		$this->forge->addField([
			'id' => [
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ip_address' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'username' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'unique'     => true,
			],
			'password' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'email' => [
				'type'       => 'VARCHAR',
				'constraint' => '254',
			],
			'activation_selector' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
				'unique'     => true,
			],
			'activation_code' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
			],
			'forgotten_password_selector' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
				'unique'     => true,
			],
			'forgotten_password_code' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
			],
			'forgotten_password_time' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => true,
				'null'       => true,
			],
			'remember_selector' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
				'unique'     => true,
			],
			'remember_code' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'       => true,
			],
			'created_on' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => true,
			],
			'last_login' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => true,
				'null'       => true,
			],
			'active' => [
				'type'       => 'TINYINT',
				'constraint' => '1',
				'unsigned'   => true,
				'null'       => true,
			],
			'fullname' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'phone' => [
				'type'       => 'VARCHAR',
				'constraint' => '20',
				'null'       => true,
			],
			'address' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => true,
			],
			'picture' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
				'default'    => 'no-images.jpg',
			],
			'uuid' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			
			/** create timestamp field */
			'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp', 
            'deleted_at datetime default null', 
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable($this->tables['users'], false);

		// Drop table 'users_groups' if it exists
		$this->forge->dropTable($this->tables['users_groups'], true);

		// Table structure for table 'users_groups'
		$this->forge->addField([
			'id' => [
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id' => [
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => true,
			],
			'group_id' => [
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => true,
			],
		]);
		$this->forge->addKey('id', true);

		$this->forge->addForeignKey('user_id', $this->tables['users'], 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addForeignKey('group_id', $this->tables['groups'], 'id', 'NO ACTION', 'CASCADE');

		$this->forge->createTable($this->tables['users_groups']);

		// Drop table 'login_attempts' if it exists
		$this->forge->dropTable($this->tables['login_attempts'], true);

		// Table structure for table 'login_attempts'
		$this->forge->addField([
			'id' => [
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'ip_address' => [
				'type'       => 'VARCHAR',
				'constraint' => '45',
			],
			'login' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => true,
			],
			'time' => [
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => true,
				'null'       => true,
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable($this->tables['login_attempts']);
	}

	/**
	 * Down
	 *
	 * @return void
	 */
	public function down()
	{
		$this->forge->dropTable($this->tables['users'], true);
		$this->forge->dropTable($this->tables['groups'], true);
		$this->forge->dropTable($this->tables['users_groups'], true);
		$this->forge->dropTable($this->tables['login_attempts'], true);
	}
}
