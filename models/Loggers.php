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

use kartik\helpers\Html;
use Yii;
use cinghie\traits\CreatedTrait;
use cinghie\traits\UserTrait;
use cinghie\traits\UserHelpersTrait;
use cinghie\traits\ViewsHelpersTrait;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%loggers}}".
 *
 * @property int $id
 * @property string $entity_name
 * @property string|null $entity_id
 * @property string|null $action
 * @property string|null $data
 * @property string|null $ip
 * @property int|null $created_by
 * @property string $created
 */
class Loggers extends ActiveRecord
{
    use CreatedTrait, UserTrait, UserHelpersTrait, ViewsHelpersTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%loggers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_name'], 'required'],
            [['created_by'], 'integer'],
            [['created'], 'safe'],
            [['data'], 'string'],
            [['ip'], 'string', 'max' => 16],
            [['entity_name', 'entity_id', 'action'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => Yii::t('traits', 'ID'),
            'entity_name' => Yii::t('traits', 'Entity Name'),
            'entity_id' => Yii::t('traits', 'Entity ID'),
            'action' => Yii::t('traits', 'Action'),
            'data' => Yii::t('traits', 'Data'),
            'ip' => Yii::t('traits', 'IP'),
        ]);
    }
    
    /**
     * @return LoggersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoggersQuery(static::class);
    }
}
