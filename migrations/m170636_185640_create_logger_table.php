<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-logger
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-logger
 * @version 0.0.1
 */

use cinghie\traits\migrations\Migration;

/**
 * Class m170636_185640_create_logger_table
 */
class m170636_185640_create_logger_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('{{%loggers}}', [
			'id' => $this->bigPrimaryKey(),
			'entity_name' => $this->string(32)->notNull(),
			'entity_id' => $this->string(32),
			'action' => $this->string(32),
			'data' => $this->text(),
			'ip' => $this->string(16),
			'created_by' => $this->integer(11)->defaultValue(null),
			'created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
		], $this->tableOptions);
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('{{%loggers}}');
	}
}
