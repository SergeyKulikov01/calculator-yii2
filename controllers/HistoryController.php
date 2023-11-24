<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
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
                'only' => ['delete'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['delete'],
                        'roles'   => ['administrator'],
                    ],
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
        if (Yii::$app->user->can('isAdmin')){
            $query = History::find();
        } else {
            $query = History::find()->where(['user_id' => Yii::$app->user->identity->id]);
        }

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
        return $this->render('view', ['model' => $array,'info' => $history]);
    }
}
