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
    protected $loggerClass = Loggers::class;
    protected $loggerSearchClass = LoggersSearch::class;

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
				        'actions' => ['index', 'timeline', 'view'],
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
        $searchModel = new $this->loggerSearchClass();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Timeline Loggers models.
     * 
     * @return mixed
     */
    /** Max length for action/entity_model (matches DB schema). */
    private const FILTER_STRING_MAX_LENGTH = 32;

    /** Max number of timeline items to load (performance). */
    private const TIMELINE_ITEMS_LIMIT = 500;

    public function actionTimeline()
    {
        $get = Yii::$app->request->get();
        $searchModel = new $this->loggerSearchClass();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $where = [];

        $action = isset($get['action']) && $get['action'] !== '' ? (string) $get['action'] : '';
        $action = mb_substr(trim($action), 0, self::FILTER_STRING_MAX_LENGTH);
        if ($action !== '') {
            $where['action'] = $action;
        }

        $created = isset($get['created']) && $get['created'] ? (string) $get['created'] : '';

        $andWhere = [];
        if ($created !== '') {
            $explode = explode(' | ', $created, 2);
            if (count($explode) === 2) {
                $start = trim($explode[0]);
                $finish = trim($explode[1]);
                $datePattern = '/^\d{4}-\d{2}-\d{2}$/';
                if (preg_match($datePattern, $start) && preg_match($datePattern, $finish)) {
                    $andWhere = ['between', 'created', $start, $finish];
                }
            }
        }

        $entityModel = isset($get['entity_model']) && $get['entity_model'] !== '' ? (string) $get['entity_model'] : '';
        $entityModel = mb_substr(trim($entityModel), 0, self::FILTER_STRING_MAX_LENGTH);
        if ($entityModel !== '') {
            $where['entity_model'] = $entityModel;
        }

        $user_id = isset($get['user_id']) && $get['user_id'] !== '' ? (int) $get['user_id'] : 0;
        if ($user_id > 0) {
            $where['created_by'] = $user_id;
        }

        $query = Loggers::find()->where($where);
        if ($andWhere !== []) {
            $query->andWhere($andWhere);
        }
        $query->orderBy('created DESC')->limit(self::TIMELINE_ITEMS_LIMIT);
        $items = $query->all();

        $days = [];
        foreach ($items as $item) {
            if (isset($item->created_date) && $item->created_date !== '') {
                $days[$item->created_date] = ['created_date' => $item->created_date];
            }
        }
        krsort($days);
        $days = array_values($days);

        return $this->render('timeline', [
            'action' => $action,
            'created' => $created,
            'days' => $days,
            'dataProvider' => $dataProvider,
            'entity_model' => $entityModel,
            'items' => $items,
            'searchModel' => $searchModel,
            'user_id' => $user_id,
            'userNames' => $searchModel->getUsersSelect2(),
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
     * 
     * @param integer $id
     * 
     * @return Loggers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->loggerClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('traits', 'The requested page does not exist.'));
    }
}
