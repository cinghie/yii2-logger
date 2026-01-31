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

namespace cinghie\logger;

use Yii;
use yii\base\Module;
use yii\i18n\PhpMessageSource;

/**
 * Class Logger
 */
class Logger extends Module
{
	/**
	 * Bootstrap version bootstrap, bootstrap4, bootstrap5
	 * 
	 * @var string 
	 */
    public $bootstrap = 'bootstrap';

	/**
	 * @var array
	 */
	public $modelMap = [];

	/**
	 * @var string[]
	 */
	public $roles = ['admin'];

	/**
	 * @var bool
	 */
	public $showTitles = false;

	/**
	 * Carriers init
	 */
	public function init()
	{
		$this->registerTranslations();

		parent::init();
	}

	/**
	 * Translating module message
	 */
	public function registerTranslations()
	{
		if (!isset(Yii::$app->i18n->translations['logger*']))
		{
			Yii::$app->i18n->translations['logger*'] = [
				'class' => PhpMessageSource::class,
				'basePath' => '@vendor/cinghie/yii2-traits/messages',
			];
		}
	}
}
