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
class m170636_185650_update_logger_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->addColumn('{{%loggers}}', 'icon', $this->string(64).' AFTER data');
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropColumn('{{%loggers}}','icon');
	}
}
