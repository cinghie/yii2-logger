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

namespace cinghie\logger\controllers;

use RuntimeException;
use Yii;
use cinghie\logger\models\Loggers;
use cinghie\logger\models\LoggersSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoggersController implements the CRUD actions for Loggers model.
 */
class LoggersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
	        'access' => [
		        'class' => AccessControl::class,
		        'rules' => [
			        [
				        'allow' => true,
				        'actions' => ['index','timeline'],
				        'roles' => $this->module->roles
			        ],
		        ],
		        'denyCallback' => static function () {
			        throw new RuntimeException(Yii::t('traits','You are not allowed to access this page'));
		        }
	        ],
        ];
    }

    /**
     * Lists all Loggers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoggersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Timeline Loggers models.
     * @return mixed
     */
    public function actionTimeline()
    {
        $get = Yii::$app->request->get();
        $searchModel = new LoggersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $where = [];

        $action = isset($get['action']) && $get['action'] ? (string)$get['action'] : '';

        if($action) {
            $where['action'] = $action;
        }

        $created = isset($get['created']) && $get['created'] ? (string)$get['created'] : '';

        if($created)
        {
            $explode = explode( ' | ', $created );
            list($start, $finish) = $explode;
            $andWhere = ['between', 'created', $start, $finish];
        } else {
            $andWhere = '';
        }

        $entityModel = isset($get['entity_model']) && $get['entity_model'] ? (string)$get['entity_model'] : 0;

        if($entityModel) {
            $where['entity_model'] = $entityModel;
        }

        $user_id = isset($get['user_id']) && $get['user_id'] ? (int)$get['user_id'] : 0;

        if($user_id) {
            $where['created_by'] = $user_id;
        }

        $items = Loggers::find()->where($where)->andWhere($andWhere)->orderBy('created DESC')->all();
        $days = Loggers::find()->where($where)->andWhere($andWhere)->select('created_date')->orderBy('created DESC')->groupBy('created_date')->all();

        return $this->render('timeline', [
            'action' => $action,
            'created' => $created,
            'days' => $days,
            'dataProvider' => $dataProvider,
            'entity_model' => $entityModel,
            'items' => $items,
            'searchModel' => $searchModel,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Displays a single Loggers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Loggers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loggers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loggers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('traits', 'The requested page does not exist.'));
    }
}
