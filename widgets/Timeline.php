<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-logger
 * @version 0.1.0
 */

namespace cinghie\logger\widgets;

use Yii;

/**
 * Class Timeline
 */
class Timeline
{
    public static function widget(array $config = [])
    {
        $module = Yii::$app->getModule('logger');
        $bootstrap = $module->bootstrap ?? 'bootstrap';

        if ($bootstrap === 'bootstrap4' && class_exists(\cinghie\adminlte3\widgets\Timeline::class)) {
            return \cinghie\adminlte3\widgets\Timeline::widget($config);
        }

        if (class_exists(\cinghie\adminlte\widgets\Timeline::class)) {
            return \cinghie\adminlte\widgets\Timeline::widget($config);
        }

        if (class_exists(\cinghie\adminlte3\widgets\Timeline::class)) {
            return \cinghie\adminlte3\widgets\Timeline::widget($config);
        }

        return '';
    }
}
