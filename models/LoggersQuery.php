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

namespace cinghie\logger\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Loggers]].
 *
 * @see Loggers
 */
class LoggersQuery extends ActiveQuery
{
    /**
     * Get last n elements
     *
     * @param int $limit
     * @param string $order
     * @param string $orderBy
     *
     * @return LoggersQuery
     */
    public function last($limit = 5, $orderBy = 'id', $order = 'DESC')
    {
        return $this->orderBy([$orderBy => $order])->limit($limit);
    }

    /**
     * @inheritdoc
     *
     * @return Loggers[]|array|null
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     *
     * @return Loggers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
