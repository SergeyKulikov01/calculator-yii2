<?php

namespace app\controllers;

use app\models\Months;
use app\models\Raw_types;
use app\models\Tonnages;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\History;

class HistoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout','users'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['users'],
                        'roles'   => ['administrator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = History::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', compact('dataProvider'));
    }
    public function actionDelete($id)
    {
        $history = History::findOne($id);
        $history->delete();

        return $this->redirect(['index']);
    }
    public function actionView($id)
    {
        $history = History::findOne($id);
        $model = json_decode($history->full_pricelist,true);
        foreach ($model as $id => $month){
            foreach ($month as $monthname => $price){
                $price['month'] = $monthname;
                $array[] = $price;
            }
        }
        return $this->render('view', [
            'model' => $array,'info' => $history
        ]);
    }
    public function actionHistory()
    {
        $calc = History::find()->asArray()->all();

        if (Yii::$app->user->can('isAdmin')){
            $calc = History::find()->asArray()->all();
            foreach ($calc as $value){
                $userRole = array_values(Yii::$app->authManager->getRolesByUser($value['user_id']));
                $monthArray = Months::find()->where(['id' => $value['month']])->select('name')->asArray()->One();
                $value['monthName'] = $monthArray['name'] ;
                $typeArray = Raw_types::find()->where(['id' => $value['type']])->select('name')->asArray()->One();
                $value['typeName'] = $typeArray['name'] ;
                $tonnageArray = Tonnages::find()->where(['id' => $value['tonnage']])->select('value')->asArray()->One();
                $value['tonnageName'] = $tonnageArray['value'] ;
                $userArray = User::find()->where(['id' => $value['user_id']])->select('name')->asArray()->One();
                $value['name'] = $userArray['name'] ;
                $value['role'] = $userRole[0]->description;
                $allCalc[] = $value;
                $admin = true;
            }
        } else {
            $userId = Yii::$app->user->id;
            $calc = History::find()->where(['user_id' => $userId])->asArray()->all();
            foreach ($calc as $value){
                $userRole = array_values(Yii::$app->authManager->getRolesByUser($value['id']));
                $monthArray = Months::find()->where(['id' => $value['month']])->select('name')->asArray()->One();
                $value['monthName'] = $monthArray['name'] ;
                $typeArray = Raw_types::find()->where(['id' => $value['type']])->select('name')->asArray()->One();
                $value['typeName'] = $typeArray['name'] ;
                $tonnageArray = Tonnages::find()->where(['id' => $value['tonnage']])->select('value')->asArray()->One();
                $value['tonnageName'] = $tonnageArray['value'] ;
                $allCalc[] = $value;
                $admin = false;
            }
        }
        return $this->render('history',compact('allCalc','admin'));
    }
}
