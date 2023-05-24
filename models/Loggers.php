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

use Yii;
use cinghie\traits\CreatedTrait;
use cinghie\traits\UserTrait;
use cinghie\traits\UserHelpersTrait;
use cinghie\traits\ViewsHelpersTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%loggers}}".
 *
 * @property int $id
 * @property string $entity_name
 * @property int $entity_id
 * @property string $entity_code
 * @property string $entity_model
 * @property string $entity_url
 * @property string|null $action
 * @property string|null $data
 * @property string|null $icon
 * @property string|null $ip
 * @property int|null $created_by
 * @property string $created
 * @property string|null $created_date
 * @property string|null $created_time
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
            [['created_by','entity_id'], 'integer'],
            [['created','created_date','created_time'], 'safe'],
            [['data'], 'string'],
            [['ip'], 'string', 'max' => 16],
            [['entity_name', 'entity_code', 'entity_model', 'action'], 'string', 'max' => 32],
            [['entity_url'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => Yii::t('traits', 'ID'),
            'entity_code' => Yii::t('traits', 'Entity Code'),
            'entity_name' => Yii::t('traits', 'Entity Name'),
            'entity_id' => Yii::t('traits', 'Entity ID'),
            'entity_model' => Yii::t('traits', 'Entity Model'),
            'entity_url' => Yii::t('traits', 'Entity ID'),
            'action' => Yii::t('traits', 'Action'),
            'data' => Yii::t('traits', 'Data'),
            'ip' => Yii::t('traits', 'IP'),
            'created_date' => Yii::t('traits', 'Created Date'),
            'created_time' => Yii::t('traits', 'Created Time'),
        ]);
    }

    /**
     * @return array|Loggers[]|null
     */
    public function getActions()
    {
        return self::find()->select('action')->distinct()->all();
    }

    /**
     * @return array|Loggers[]|null
     */
    public function getModels()
    {
        return self::find()->select('entity_model')->distinct()->all();
    }

    /**
     * @return string
     */
    public function getActionsSelect2($value = '')
    {
        $actions = $this->getActions();
        $html = '<select name="action" class="form-control">';
        $html .= '<option value="">Filtra per azione ...</option>';

        foreach ($actions as $action)
        {
            $selected = ($value === $action['action']) ? 'selected' : '';

            if(isset($action['action']) && $action['action']) {
                $html .= '<option value="'.$action['action'].'"'.$selected.'>'.Yii::t('traits', $action['action']).'</option>';
            }
        }

        $html .= '</select>';

        return $html;
    }

    /**
     * @return string
     */
    public function getModelsSelect2($value = '')
    {
        $models = $this->getModels();
        $html = '<select name="entity_model" class="form-control">';
        $html .= '<option value="">Filtra per oggetto ...</option>';

        foreach ($models as $model)
        {
            if(isset($model['entity_model']) && $model['entity_model'])
            {
                $selected = ($value === $model['entity_model']) ? 'selected' : '';

                $html .= '<option value="'.$model['entity_model'].'"'.$selected.'>'.Yii::t('traits', $model['entity_model']).'</option>';
            }
        }

        $html .= '</select>';

        return $html;
    }
    
    /**
     * @return LoggersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoggersQuery(static::class);
    }
}
